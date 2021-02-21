<?php
include '../../conexion/conexion.php';
$id_ubicacion = $_POST["id_ubicacion"];
$ubicacion = $_POST['ubicacion'];
$activo = 1;

try {
    $qry_update = $conexion->prepare("UPDATE ubicaciones SET ubicacion = '$ubicacion' WHERE id_ubicacion = '$id_ubicacion'");

    $qry_update->execute();
    echo "La Ubicación: $ubicacion fue actualizada correctamente";
} catch (PDOException $error) {
    echo "Ha ocurrido el siguiente error: " . $error->getMessage();
}
