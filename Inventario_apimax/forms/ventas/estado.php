<?php
include '../../conexion/conexion.php';
$id_detalle_venta = $_GET["id_detalle_venta"];
$estado = $_GET["estado"];

$nuevo_activo = ($estado == 1 ? 0 : 1);
date_default_timezone_set("America/Monterrey");

$qry_update = $conexion->prepare("UPDATE detalle_ventas SET activo = $nuevo_activo WHERE id_detalle_venta = $id_detalle_venta");

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
