<?php
include '../../conexion/conexion.php';
$id_tamano_frasco = $_GET["id_tamano_frasco"];
$estado = $_GET["estado"];

$nuevo_activo = ($estado == 1 ? 0 : 1);
date_default_timezone_set("America/Monterrey");

$qry_update = $conexion->prepare("UPDATE tamanos_frascos SET activo = $nuevo_activo WHERE id_tamano_frasco = $id_tamano_frasco");

try {
    $qry_update->execute();
    header("Location:index.php");
} catch (PDOException $error) {
    echo $error->getMessage();
}
