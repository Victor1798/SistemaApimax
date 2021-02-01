<?php
include '../../conexion/conexion.php';
$id_usuario = $_GET["id_usuario"];

$qry_delete = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario = $id_usuario");

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