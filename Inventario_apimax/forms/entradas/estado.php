<?php
include '../../conexion/conexion.php';
$id_entrada = $_GET["id_entrada"];
$estado = $_GET["estado"];

$nuevo_activo = ($estado == 1 ? 0 : 1);
date_default_timezone_set("America/Monterrey");

$qry_update = $conexion->prepare("UPDATE entradas SET activo = $nuevo_activo WHERE id_entrada = $id_entrada");

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
