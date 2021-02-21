<?php
include '../../conexion/conexion.php';

$ubicacion = $_POST['ubicacion'];
$fecha_registro = date("y.m.d");
$activo = 1;

try {
    $qry_insert = $conexion->prepare("INSERT INTO ubicaciones(ubicacion, fecha_registro, activo)VALUES('$ubicacion', '$fecha_registro', '$activo')");

    $qry_insert->execute();
    echo "Nueva Ubicación: $ubicacion fue insertada correctamente";
} catch (PDOException $error) {
    echo "Ha ocurrido el siguiente error: " . $error->getMessage();
}
