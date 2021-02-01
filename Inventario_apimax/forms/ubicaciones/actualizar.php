<?php
include '../../conexion/conexion.php';
$id_usuario = $_POST["id_usuario"];
$nombre = $_POST['nombre'];
$ap_paterno = $_POST['ap_paterno'];
$ap_materno = $_POST['ap_materno'];
$fecha_nac = $_POST['fecha_nac'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
$activo = 1;

    try
    {
        $qry_update = $conexion->prepare("UPDATE usuarios SET nombre = '$nombre', ap_paterno = '$ap_paterno', ap_materno = '$ap_materno', fecha_nac = '$fecha_nac', direccion = '$direccion', correo = '$correo', telefono = '$telefono', usuario = '$usuario', pass = '$pass' WHERE id_usuario = '$id_usuario'");
    
        $qry_update->execute();
        echo "El usuario: $nombre fue actualizado correctamente";
    }
    catch(PDOException $error)
    {
        echo "Ha ocurrido el siguiente error: ".$error->getMessage();
    }
?>