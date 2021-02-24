<?php
include '../../conexion/conexion.php';
$id_lote = $_GET["id_lote"];
$estado = $_GET["estado"];

$nuevo_activo = ($estado == 1 ? 0 : 1);
date_default_timezone_set("America/Monterrey");

$qry_update = $conexion->prepare("UPDATE lotes SET activo = $nuevo_activo WHERE id_lote = $id_lote");

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