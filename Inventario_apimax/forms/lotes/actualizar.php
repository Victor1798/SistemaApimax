<?php
include '../../conexion/conexion.php';
$id_lote = $_POST["id_lote"];
$id_ubicacion = $_POST['id_ubicacion'];
$id_apiario = $_POST['id_apiario'];
$fecha_produccion = $_POST['fecha_produccion'];

$activo = 1;

    try
    {
        $qry_update = $conexion->prepare("UPDATE lotes SET id_ubicacion = '$id_ubicacion', id_apiario = '$id_apiario',  fecha_produccion = '$fecha_produccion'
        WHERE id_lote = '$id_lote'");

        $qry_update->execute();
        echo "El lote: $fecha_produccion fue actualizado correctamente";
    }
    catch(PDOException $error)
    {
        echo "Ha ocurrido el siguiente error: ".$error->getMessage();
    }
?>