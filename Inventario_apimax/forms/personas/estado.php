<?php
include '../../conexion/conexion.php';
$id_persona = $_GET["id_persona"];
$estado = $_GET["estado"];

$nuevo_activo = ($estado == 1 ? 0 : 1);
date_default_timezone_set("America/Monterrey");

$qry_update = $conexion->prepare("UPDATE personas SET activo = $nuevo_activo WHERE id_persona = $id_persona");

try
{
    $qry_update->execute();
    header("Location:index.php");
}
catch(PDOException $error)
{
    echo $error->getMessage();
}
?>