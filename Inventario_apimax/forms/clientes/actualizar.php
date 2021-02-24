<?php
include '../../conexion/conexion.php';

$id_cliente = $_POST["id_cliente"];
$id_persona = $_POST['id_persona'];
$activo = 1;

    try
    {
        $qry_update = $conexion->prepare("UPDATE clientes SET id_persona = '$id_persona' WHERE id_cliente = '$id_cliente'");

        $qry_update->execute();
        echo "El Cliente: $nombre fue actualizado correctamente";
    }
    catch(PDOException $error)
    {
        echo "Ha ocurrido el siguiente error: ".$error->getMessage();
    }
