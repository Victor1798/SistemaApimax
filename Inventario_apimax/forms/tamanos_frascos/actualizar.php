<?php
include '../../conexion/conexion.php';
$id_tamano_frasco = $_POST["id_tamano_frasco"];
$tamano_frasco = $_POST['tamano_frasco'];
$activo = 1;

try {
    $qry_update = $conexion->prepare("UPDATE tamanos_frascos SET tamano_frasco = '$tamano_frasco' WHERE id_tamano_frasco = '$id_tamano_frasco'");

    $qry_update->execute();
    echo "El tamano del frasco: $tamano_frasco fue actualizado correctamente";
} catch (PDOException $error) {
    echo "Ha ocurrido el siguiente error: " . $error->getMessage();
}
