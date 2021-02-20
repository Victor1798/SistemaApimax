<?php
include '../../conexion/conexion.php';

$nombre = $_POST['nombre'];
$ap_paterno = $_POST['ap_paterno'];
$ap_materno = $_POST['ap_materno'];
$fecha_nac = $_POST['fecha_nac'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

$fecha_registro = date("y.m.d");

$activo = 1;

try
{
    $qry_insert = $conexion->prepare("INSERT INTO personas(nombre, ap_paterno, ap_materno, fecha_nac, direccion, correo, telefono, fecha_registro, activo)
    VALUES('$nombre', '$ap_paterno', '$ap_materno', '$fecha_nac', '$direccion', '$correo', '$telefono', '$fecha_registro', '$activo')");

    $qry_insert->execute();
    echo "Nueva persona: $nombre fue insertada correctamente";
}
catch(PDOException $error)
{
    echo "Ha ocurrido el siguiente error: ".$error->getMessage();
}


?>