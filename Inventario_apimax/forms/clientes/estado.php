<?php
include '../../conexion/conexion.php';
$id_cliente = $_GET["id_cliente"];
$estado = $_GET["estado"];

$nuevo_activo = ($estado == 1 ? 0 : 1);
date_default_timezone_set("America/Monterrey");

$qry_update = $conexion->prepare("UPDATE clientes SET activo = $nuevo_activo WHERE id_cliente = $id_cliente");

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