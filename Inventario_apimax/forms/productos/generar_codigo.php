<?php
include '../../conexion/conexion.php';
$id_producto = $_POST["id_producto"];
$codigo = $_POST['codigo'];



$activo = 1;

    try
    {
        $qry_update = $conexion->prepare("UPDATE productos SET codigo = '$codigo'
        WHERE id_producto = '$id_producto'");

        $qry_update->execute();
        echo "El producto: $producto fue actualizado correctamente";
    }
    catch(PDOException $error)
    {
        echo "Ha ocurrido el siguiente error: ".$error->getMessage();
    }
?>