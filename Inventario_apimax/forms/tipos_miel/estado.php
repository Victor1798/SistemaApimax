<?php
include '../../conexion/conexion.php';
$id_tipo_miel = $_GET["id_tipo_miel"];
$estado = $_GET["estado"];

$nuevo_activo = ($estado == 1 ? 0 : 1);
date_default_timezone_set("America/Monterrey");

$qry_update = $conexion->prepare("UPDATE tipos_miel SET activo = $nuevo_activo WHERE id_tipo_miel = $id_tipo_miel");

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