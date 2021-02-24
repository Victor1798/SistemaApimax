<?php
include '../../conexion/conexion.php';

$id_persona = $_POST['id_persona'];
$fecha_registro = date("y.m.d");
$activo = 1;

try
{
    $qry_insert = $conexion->prepare("INSERT INTO clientes(id_persona, fecha_registro, activo)
    VALUES('$id_persona', '$fecha_registro', '$activo')");

    $qry_insert->execute();
    echo "Nuevo Cliente: $nombre fue insertado correctamente";
}
catch(PDOException $error)
{
    echo "Ha ocurrido el siguiente error: ".$error->getMessage();
}


?>