<?php
include '../../conexion/conexion.php';
$id_producto = $_POST["id_producto"];
$producto = $_POST['producto'];
$id_tipo_miel = $_POST['id_tipo_miel'];
$tamano_frasco = $_POST['tamano_frasco'];
$precio = $_POST['precio'];


$activo = 1;

    try
    {
        $qry_update = $conexion->prepare("UPDATE productos SET producto = '$producto', id_tipo_miel = '$id_tipo_miel', tamano_frasco = '$tamano_frasco',  precio = '$precio'
        WHERE id_producto = '$id_producto'");

        $qry_update->execute();
        echo "El producto: $producto fue actualizado correctamente";
    }
    catch(PDOException $error)
    {
        echo "Ha ocurrido el siguiente error: ".$error->getMessage();
    }
?>