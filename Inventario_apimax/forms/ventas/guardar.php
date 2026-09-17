<?php
declare(strict_types=1);

require_once '../../conexion/conexion.php';
require_once '../../seguridad/funciones.php';
exigir_sesion('../../index.php');

$id_detalle = $_POST['id_detalle_venta'] ?? '';
$id_venta = entero($_POST['id_venta'] ?? null, 'venta');
$id_producto = entero($_POST['id_producto'] ?? null, 'producto');
$id_lote = entero($_POST['id_lote'] ?? null, 'lote');
$tipo_venta = trim((string) ($_POST['tipo_venta'] ?? ''));
$estado_pago = (string) ($_POST['estado_pago'] ?? '');
$fecha_pago = $_POST['fecha_pago'] ?? date('Y-m-d');
$cantidad = decimal($_POST['cantidad'] ?? null, 'cantidad', 0.01);
$descuento_pesos = decimal($_POST['descuento_pesos'] ?: 0, 'descuento', 0);
$descuento_porcen = decimal($_POST['descuento_porcen'] ?: 0, 'descuento', 0);
$precio = decimal($_POST['precio'] ?? null, 'precio', 0);
$total = decimal($_POST['total'] ?? null, 'total', 0);
$dinero_descontado = decimal($_POST['precio_oculto'] ?: 0, 'dinero descontado', 0);
$fecha_registro = date('Y-m-d');

if (!in_array($tipo_venta, ['Contado', 'Consigna'], true) || !in_array($estado_pago, ['1', '2'], true) || $descuento_porcen > 100) {
    respuesta_error(new InvalidArgumentException('Los datos de la venta no son válidos.'));
}

try {
    $conexion->beginTransaction();
    $cantidad_anterior = 0.0;
    $producto_anterior = $id_producto;
    $lote_anterior = $id_lote;

    if ($id_detalle !== '') {
        $buscar = $conexion->prepare('SELECT id_producto, id_lote, cantidad FROM detalle_ventas WHERE id_detalle_venta = :id FOR UPDATE');
        $buscar->execute(['id' => entero($id_detalle, 'detalle')]);
        $anterior = $buscar->fetch();
        if (!$anterior) throw new RuntimeException('No se encontró el detalle de venta.');
        $cantidad_anterior = (float) $anterior['cantidad'];
        $producto_anterior = (int) $anterior['id_producto'];
        $lote_anterior = (int) $anterior['id_lote'];
        $devolver = $conexion->prepare('UPDATE entradas SET cantidad_vendida = GREATEST(0, cantidad_vendida - :cantidad) WHERE id_producto = :producto AND id_lote = :lote');
        $devolver->execute(['cantidad' => $cantidad_anterior, 'producto' => $producto_anterior, 'lote' => $lote_anterior]);
    }

    $reservar = $conexion->prepare('UPDATE entradas SET cantidad_vendida = cantidad_vendida + :cantidad WHERE id_producto = :producto AND id_lote = :lote AND (cantidad - cantidad_vendida - cantidad_desperdiciada) >= :cantidad');
    $reservar->execute(['cantidad' => $cantidad, 'producto' => $id_producto, 'lote' => $id_lote]);
    if (!$reservar->rowCount()) throw new RuntimeException('No hay inventario suficiente para este producto y lote.');

    $datos = ['venta' => $id_venta, 'producto' => $id_producto, 'lote' => $id_lote, 'tipo' => $tipo_venta, 'estado' => $estado_pago, 'fecha_pago' => $fecha_pago, 'cantidad' => $cantidad, 'descuento_pesos' => $descuento_pesos, 'descuento_porcen' => $descuento_porcen, 'precio' => $precio, 'total' => $total, 'dinero' => $dinero_descontado, 'fecha_registro' => $fecha_registro, 'activo' => 1];
    if ($id_detalle === '') {
        $consulta = $conexion->prepare('INSERT INTO detalle_ventas(id_venta, id_producto, id_lote, tipo_venta, estado_pago, fecha_pago, cantidad, descuento_pesos, descuento_porcen, precio, total, dinero_descontado, fecha_registro, activo) VALUES(:venta, :producto, :lote, :tipo, :estado, :fecha_pago, :cantidad, :descuento_pesos, :descuento_porcen, :precio, :total, :dinero, :fecha_registro, :activo)');
        $mensaje = 'Registrado correctamente';
    } else {
        $consulta = $conexion->prepare('UPDATE detalle_ventas SET id_venta = :venta, id_producto = :producto, id_lote = :lote, tipo_venta = :tipo, estado_pago = :estado, fecha_pago = :fecha_pago, cantidad = :cantidad, descuento_pesos = :descuento_pesos, descuento_porcen = :descuento_porcen, precio = :precio, total = :total, dinero_descontado = :dinero, activo = :activo WHERE id_detalle_venta = :id');
        $datos['id'] = entero($id_detalle, 'detalle');
        $mensaje = 'Actualizado correctamente';
    }
    $consulta->execute($datos);
    $conexion->commit();
    echo $mensaje;
} catch (Throwable $error) {
    if ($conexion->inTransaction()) $conexion->rollBack();
    respuesta_error($error);
}
