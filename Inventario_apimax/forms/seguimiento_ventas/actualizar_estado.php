<?php
include "../../conexion/conexion.php";

try {

	$id_venta = $_POST["id_venta"];
    $estado_pago = $_POST["estado_pago"];


	$consulta = $conexion->prepare("UPDATE ventas SET estado_pago = '$estado_pago' WHERE id_venta = '$id_venta'");
	$consulta->execute();

	echo "Actualizado correctamente";
} catch (PDOException $error) {

	echo $error->getMessage();
}
