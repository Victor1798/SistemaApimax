<?php
include '../../conexion/conexion.php';
$id_ubicacion = $_GET["id_ubicacion"];
$estado = $_GET["estado"];

$nuevo_activo = ($estado == 1 ? 0 : 1);
date_default_timezone_set("America/Monterrey");

$qry_update = $conexion->prepare("UPDATE ubicaciones SET activo = $nuevo_activo WHERE id_ubicacion = $id_ubicacion");

try {
    $qry_update->execute();
    header("Location:index.php");
} catch (PDOException $error) {
    echo $error->getMessage();
}
