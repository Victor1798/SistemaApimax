<?php
include '../../conexion/conexion.php';

$tipo_miel = $_POST['tipo_miel'];
$activo = 1;

try {
    $qry_insert = $conexion->prepare("INSERT INTO tipos_miel(tipo_miel, activo)VALUES('$tipo_miel', '$activo')");

    $qry_insert->execute();
    echo "Nuevo Tipo de Miel: $tipo_miel fue insertado correctamente";
} catch (PDOException $error) {
    echo "Ha ocurrido el siguiente error: " . $error->getMessage();
}
