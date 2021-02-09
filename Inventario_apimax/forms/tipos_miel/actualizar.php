<?php
include '../../conexion/conexion.php';
$id_tipo_miel = $_POST["id_tipo_miel"];
$tipo_miel = $_POST['tipo_miel'];
$activo = 1;

try {
    $qry_update = $conexion->prepare("UPDATE tipos_miel SET tipo_miel = '$tipo_miel' WHERE id_tipo_miel = '$id_tipo_miel'");

    $qry_update->execute();
    echo "El Tipo de Miel: $tipo_miel fue actualizado correctamente";
} catch (PDOException $error) {
    echo "Ha ocurrido el siguiente error: " . $error->getMessage();
}
