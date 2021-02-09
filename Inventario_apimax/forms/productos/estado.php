<?php
include '../../conexion/conexion.php';
$id_producto = $_GET["id_producto"];
$estado = $_GET["estado"];

$nuevo_activo = ($estado == 1 ? 0 : 1);
date_default_timezone_set("America/Monterrey");

$qry_update = $conexion->prepare("UPDATE productos SET activo = $nuevo_activo WHERE id_producto = $id_producto");

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