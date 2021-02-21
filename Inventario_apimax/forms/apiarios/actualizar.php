<?php
include '../../conexion/conexion.php';
$id_apiario = $_POST["id_apiario"];
$nombre = $_POST['nombre'];
$activo = 1;

try {
    $qry_update = $conexion->prepare("UPDATE apiarios SET nombre = '$nombre' WHERE id_apiario = '$id_apiario'");

    $qry_update->execute();
    echo "El Apiario: $nombre fue actualizado correctamente";
} catch (PDOException $error) {
    echo "Ha ocurrido el siguiente error: " . $error->getMessage();
}
