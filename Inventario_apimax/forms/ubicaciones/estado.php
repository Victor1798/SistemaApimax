<?php
include '../../conexion/conexion.php';
$id_usuario = $_GET["id_usuario"];
$estado = $_GET["estado"];

$nuevo_activo = ($estado == 1 ? 0 : 1);
date_default_timezone_set("America/Monterrey");

$qry_update = $conexion->prepare("UPDATE usuarios SET activo = $nuevo_activo WHERE id_usuario = $id_usuario");

try {
    $qry_update->execute();
    header("Location:index.php");
} catch (PDOException $error) {
    echo $error->getMessage();
}
