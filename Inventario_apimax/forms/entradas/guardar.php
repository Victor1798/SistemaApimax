<?php
declare(strict_types=1);
require_once '../../conexion/conexion.php';
require_once '../../seguridad/funciones.php';
exigir_sesion('../../index.php');

$id_entrada = $_POST['id_entrada'] ?? '';
$id_producto = entero($_POST['id_producto'] ?? null, 'producto');
$id_lote = entero($_POST['id_lote'] ?? null, 'lote');
$cantidad = decimal($_POST['cantidad'] ?? null, 'cantidad', 0.01);
$precio = decimal($_POST['precio'] ?? null, 'precio', 0);
$fecha_entrada = $_POST['fecha_entrada'] ?? date('Y-m-d');


$fecha_registro = date('Y-m-d');

$activo = 1;


try {
	$conexion->beginTransaction();
	if (empty($id_entrada)) {

		$consulta = $conexion->prepare('INSERT INTO entradas(id_producto, id_lote, cantidad, precio, fecha_entrada, fecha_registro, activo) VALUES(:producto, :lote, :cantidad, :precio, :fecha_entrada, :fecha_registro, :activo)');
		$consulta->execute(['producto' => $id_producto, 'lote' => $id_lote, 'cantidad' => $cantidad, 'precio' => $precio, 'fecha_entrada' => $fecha_entrada, 'fecha_registro' => $fecha_registro, 'activo' => $activo]);

		$mensaje = "Registrado correctamente";
	} else {

		$consulta = $conexion->prepare('UPDATE entradas SET id_producto = :producto, id_lote = :lote, cantidad = :cantidad, precio = :precio, fecha_entrada = :fecha_entrada, activo = :activo WHERE id_entrada = :id');
		$consulta->execute(['producto' => $id_producto, 'lote' => $id_lote, 'cantidad' => $cantidad, 'precio' => $precio, 'fecha_entrada' => $fecha_entrada, 'activo' => $activo, 'id' => entero($id_entrada, 'entrada')]);

		$mensaje = "Actualizado correctamente";
	}

	if (!$consulta->rowCount()) throw new RuntimeException('No se encontró la entrada indicada.');
	$conexion->commit();
	echo $mensaje;
} catch (PDOException $error) {
	if ($conexion->inTransaction()) $conexion->rollBack();
	respuesta_error($error);
} catch (Throwable $error) {
	if ($conexion->inTransaction()) $conexion->rollBack();
	respuesta_error($error);
}
