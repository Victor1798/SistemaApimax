<?php
include '../../conexion/conexion.php';

$tamano_frasco = $_POST['tamano_frasco'];
$fecha_registro = date("y.m.d");

$activo = 1;

try {
    $qry_insert = $conexion->prepare("INSERT INTO tamanos_frascos(tamano_frasco, fecha_registro, activo)
    VALUES('$tamano_frasco', '$fecha_registro', '$activo')");

    $qry_insert->execute();
    echo "Nuevo tamaño de frasco: $tamano_frasco fue insertado correctamente";
} catch (PDOException $error) {
    echo "Ha ocurrido el siguiente error: " . $error->getMessage();
}
