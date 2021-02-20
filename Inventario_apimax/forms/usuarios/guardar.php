<?php
include '../../conexion/conexion.php';

$id_persona = $_POST['id_persona'];
$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
$tipo_user = $_POST['tipo_user'];

$fecha_registro = date("y.m.d");

$activo = 1;

try
{
    $qry_insert = $conexion->prepare("INSERT INTO usuarios(id_persona, usuario, pass, tipo_usuario, fecha_registro, activo)
    VALUES('$id_persona', '$usuario', '$pass', '$tipo_user', '$fecha_registro', '$activo')");

    $qry_insert->execute();
    echo "Nuevo usuario: $nombre fue insertado correctamente";
}
catch(PDOException $error)
{
    echo "Ha ocurrido el siguiente error: ".$error->getMessage();
}


?>