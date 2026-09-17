<?php
declare(strict_types=1);
require_once '../../conexion/conexion.php';
require_once '../../seguridad/funciones.php';
exigir_sesion('../../index.php');

try {
    $id = entero($_POST['id_detalle_venta'] ?? null, 'detalle');
    $conexion->beginTransaction();
    $buscar = $conexion->prepare('SELECT id_producto, id_lote, cantidad FROM detalle_ventas WHERE id_detalle_venta = :id FOR UPDATE');
    $buscar->execute(['id' => $id]);
    $detalle = $buscar->fetch();
    if (!$detalle) throw new RuntimeException('No se encontró el detalle de venta.');

    $devolver = $conexion->prepare('UPDATE entradas SET cantidad_vendida = GREATEST(0, cantidad_vendida - :cantidad) WHERE id_producto = :producto AND id_lote = :lote');
    $devolver->execute(['cantidad' => $detalle['cantidad'], 'producto' => $detalle['id_producto'], 'lote' => $detalle['id_lote']]);
    $borrar = $conexion->prepare('DELETE FROM detalle_ventas WHERE id_detalle_venta = :id');
    $borrar->execute(['id' => $id]);
    $conexion->commit();
    echo 'Eliminado correctamente';
} catch (Throwable $error) {
    if ($conexion->inTransaction()) $conexion->rollBack();
    respuesta_error($error);
}
