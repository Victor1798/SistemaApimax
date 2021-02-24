<?php
include '../../conexion/conexion.php';

$id_ubicacion = $_POST['id_ubicacion'];
$id_apiario = $_POST['id_apiario'];
$fecha_produccion = $_POST['fecha_produccion'];
$fecha_registro = date("y.m.d");

$activo = 1;

try {
    $qry_insert = $conexion->prepare("INSERT INTO lotes(id_ubicacion, id_apiario, fecha_produccion, fecha_registro, activo)
    VALUES('$id_ubicacion', '$id_apiario', '$fecha_produccion', '$fecha_registro', '$activo')");
    $qry_insert->execute();
    echo "Nuevo lote: $fecha_produccion fue insertado correctamente";
} catch (PDOException $error) {
    echo "Ha ocurrido el siguiente error: " . $error->getMessage();
}
