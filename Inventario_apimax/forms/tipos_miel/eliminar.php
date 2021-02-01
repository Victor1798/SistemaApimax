<?php
include '../../conexion/conexion.php';
$id_tipo_miel = $_GET["id_tipo_miel"];

$qry_delete = $conexion->prepare("DELETE FROM tipos_miel WHERE id_tipo_miel = $id_tipo_miel");

try
{
    $qry_delete->execute();
    header("Location:index.php");
    echo "Registro eliminado";
}

catch(PDOException $error)
{
    echo $error->getMessage();
}
?>