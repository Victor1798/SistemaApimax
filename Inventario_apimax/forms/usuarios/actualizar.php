<?php
include '../../conexion/conexion.php';

$id_usuario = $_POST["id_usuario"];
$id_persona = $_POST['id_persona'];
$tipo_user = $_POST['tipo_user'];
$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
$activo = 1;

    try
    {
        $qry_update = $conexion->prepare("UPDATE usuarios SET id_persona = '$id_persona', usuario = '$usuario', pass = '$pass', tipo_usuario = '$tipo_user'
        WHERE id_usuario = '$id_usuario'");

        $qry_update->execute();
        echo "El usuario: $nombre fue actualizado correctamente";
    }
    catch(PDOException $error)
    {
        echo "Ha ocurrido el siguiente error: ".$error->getMessage();
    }
