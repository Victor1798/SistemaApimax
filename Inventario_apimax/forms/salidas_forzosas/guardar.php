<?php
declare(strict_types=1);
require_once '../../conexion/conexion.php';
require_once '../../seguridad/funciones.php';
exigir_sesion('../../index.php');

$id_desperdicio = $_POST['id_desperdicio'] ?? '';
$id_producto = entero($_POST['id_producto'] ?? null, 'producto');
$id_lote = entero($_POST['id_lote'] ?? null, 'lote');
$cantidad_desperdiciada = decimal($_POST['cantidad_desperdiciada'] ?? null, 'cantidad', 0.01);
$descripcion = trim((string) ($_POST['descripcion'] ?? ''));
$fecha = $_POST['fecha'] ?? date('Y-m-d');
$precio = decimal($_POST['precio'] ?? null, 'precio', 0);
$total = decimal($_POST['total'] ?? null, 'total', 0);
$fecha_registro = date('Y-m-d');
$activo = 1;


try {
	$conexion->beginTransaction();
	if (!empty($id_desperdicio)) {
		$anterior = $conexion->prepare('SELECT id_producto, id_lote, cantidad_desperdiciada FROM salidas_forzosas WHERE id_desperdicio = :id FOR UPDATE');
		$anterior->execute(['id' => entero($id_desperdicio, 'salida')]);
		$fila_anterior = $anterior->fetch();
		if (!$fila_anterior) throw new RuntimeException('No se encontró la salida indicada.');
		$revertir = $conexion->prepare('UPDATE entradas SET cantidad_desperdiciada = GREATEST(0, cantidad_desperdiciada - :cantidad) WHERE id_producto = :producto AND id_lote = :lote');
		$revertir->execute(['cantidad' => $fila_anterior['cantidad_desperdiciada'], 'producto' => $fila_anterior['id_producto'], 'lote' => $fila_anterior['id_lote']]);
	}
	if (empty($id_desperdicio)) {

		$consulta = $conexion->prepare('INSERT INTO salidas_forzosas(id_producto, id_lote, cantidad_desperdiciada, descripcion, fecha, precio, total, fecha_registro, activo) VALUES(:producto, :lote, :cantidad, :descripcion, :fecha, :precio, :total, :fecha_registro, :activo)');

		$consulta2 = $conexion->prepare('UPDATE entradas SET cantidad_desperdiciada = cantidad_desperdiciada + :cantidad WHERE id_producto = :producto AND id_lote = :lote AND (cantidad - cantidad_vendida - cantidad_desperdiciada) >= :cantidad');

		$mensaje = "Registrado correctamente";
	} else {

		$consulta = $conexion->prepare('UPDATE salidas_forzosas SET id_producto = :producto, id_lote = :lote, cantidad_desperdiciada = :cantidad, descripcion = :descripcion, fecha = :fecha, precio = :precio, total = :total, activo = :activo WHERE id_desperdicio = :id');

		$consulta2 = $conexion->prepare('UPDATE entradas SET cantidad_desperdiciada = cantidad_desperdiciada + :cantidad WHERE id_producto = :producto AND id_lote = :lote AND (cantidad - cantidad_vendida - cantidad_desperdiciada) >= :cantidad');

		$mensaje = "Actualizado correctamente";
	}

	$parametros = ['producto' => $id_producto, 'lote' => $id_lote, 'cantidad' => $cantidad_desperdiciada, 'descripcion' => $descripcion, 'fecha' => $fecha, 'precio' => $precio, 'total' => $total, 'fecha_registro' => $fecha_registro, 'activo' => $activo, 'id' => (int) $id_desperdicio];
	$consulta->execute($parametros);
	$consulta2->execute(['cantidad' => $cantidad_desperdiciada, 'producto' => $id_producto, 'lote' => $id_lote]);
	if (!$consulta2->rowCount()) throw new RuntimeException('No hay inventario suficiente para registrar la salida.');
	$conexion->commit();

	echo $mensaje;
} catch (PDOException $error) {

	if ($conexion->inTransaction()) $conexion->rollBack();
	respuesta_error($error);
}
