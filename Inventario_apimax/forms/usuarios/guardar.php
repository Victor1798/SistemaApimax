<?php
include '../../conexion/conexion.php';

$nombre = $_POST['nombre'];
$ap_paterno = $_POST['ap_paterno'];
$ap_materno = $_POST['ap_materno'];
$fecha_nac = $_POST['fecha_nac'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
$tipo_user = $_POST['tipo_user'];

$fecha_registro = date("y.m.d");

$activo = 1;

try
{
    $qry_insert = $conexion->prepare("INSERT INTO usuarios(nombre, ap_paterno, ap_materno, fecha_nac, direccion, correo, telefono, usuario, pass, tipo_usuario, fecha_registro, activo)VALUES('$nombre', '$ap_paterno', '$ap_materno', '$fecha_nac', '$direccion', '$correo', '$telefono', '$usuario', '$pass', '$tipo_user', '$fecha_registro', '$activo')");
    
    $qry_insert->execute();
    echo "Nuevo usuario: $nombre fue insertado correctamente";
}
catch(PDOException $error)
{
    echo "Ha ocurrido el siguiente error: ".$error->getMessage();
}


?>