<?php
include '../../conexion/conexion.php';
$id_desperdicio = $_GET["id_desperdicio"];
$estado = $_GET["estado"];

$nuevo_activo = ($estado == 1 ? 0 : 1);
date_default_timezone_set("America/Monterrey");

$qry_update = $conexion->prepare("UPDATE salidas_forzosas SET activo = $nuevo_activo WHERE id_desperdicio = $id_desperdicio");

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
