<?php
include "../../conexion/conexion.php";

try {
	$id_detalle_venta = $_POST["id_detalle_venta"];


	$consulta = $conexion->prepare("SELECT id_detalle_venta, id_producto, id_lote, cantidad FROM detalle_ventas WHERE id_detalle_venta = $id_detalle_venta");

	$consulta->execute();
	$row = $consulta->fetch(PDO::FETCH_NUM);

	$array_json = json_encode($row);
	echo $array_json;
} catch (PDOException $error) {

	echo $error->getMessage();
}
