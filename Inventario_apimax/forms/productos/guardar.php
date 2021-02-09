<?php
include '../../conexion/conexion.php';

$producto = $_POST['producto'];
$id_tipo_miel = $_POST['id_tipo_miel'];
$tamano_frasco = $_POST['tamano_frasco'];
$precio = $_POST['precio'];

$fecha_registro = date("y.m.d");

$activo = 1;

try {
    $qry_insert = $conexion->prepare("INSERT INTO productos(producto, id_tipo_miel, tamano_frasco, precio, fecha_registro, activo)
    VALUES('$producto', '$id_tipo_miel', '$tamano_frasco', '$precio', '$fecha_registro', '$activo')");
    $qry_insert->execute();
    echo "Nuevo producto: $producto fue insertado correctamente";
} catch (PDOException $error) {
    echo "Ha ocurrido el siguiente error: " . $error->getMessage();
}
