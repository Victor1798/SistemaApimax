<?php
include '../../conexion/conexion.php';

$nombre = $_POST['nombre'];
$fecha_registro = date("y.m.d");

$activo = 1;

try {
    $qry_insert = $conexion->prepare("INSERT INTO apiarios(nombre, fecha_registro, activo)
    VALUES('$nombre', '$fecha_registro', '$activo')");

    $qry_insert->execute();
    echo "Nuevo Apiario: $nombre fue insertado correctamente";
} catch (PDOException $error) {
    echo "Ha ocurrido el siguiente error: " . $error->getMessage();
}
