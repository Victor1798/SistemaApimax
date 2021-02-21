<?php
include '../../conexion/conexion.php';
$id_apiario = $_GET["id_apiario"];
$estado = $_GET["estado"];

$nuevo_activo = ($estado == 1 ? 0 : 1);
date_default_timezone_set("America/Monterrey");

$qry_update = $conexion->prepare("UPDATE apiarios SET activo = $nuevo_activo WHERE id_apiario = $id_apiario");

try {
    $qry_update->execute();
    header("Location:index.php");
} catch (PDOException $error) {
    echo $error->getMessage();
}
