<?php
include '../../conexion/conexion.php';

$id_persona = $_POST["id_persona"];
$nombre = $_POST['nombre'];
$ap_paterno = $_POST['ap_paterno'];
$ap_materno = $_POST['ap_materno'];
$fecha_nac = $_POST['fecha_nac'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$activo = 1;

    try
    {
        $qry_update = $conexion->prepare("UPDATE personas SET nombre = '$nombre', ap_paterno = '$ap_paterno', ap_materno = '$ap_materno', fecha_nac = '$fecha_nac', direccion = '$direccion', correo = '$correo', telefono = '$telefono'
        WHERE id_persona = '$id_persona'");

        $qry_update->execute();
        echo "La persona: $nombre fue actualizada correctamente";
    }
    catch(PDOException $error)
    {
        echo "Ha ocurrido el siguiente error: ".$error->getMessage();
    }
?>