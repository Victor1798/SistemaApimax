<?php
include "../../conexion/conexion.php";

try {
	$id_venta = $_POST["id_venta"];

	$consulta = $conexion->prepare("SELECT COUNT(estado_pago) FROM detalle_ventas WHERE id_venta = '$id_venta' AND estado_pago = '2'");

	$consulta->execute();
	$row = $consulta->fetch(PDO::FETCH_NUM);

	$array_json = json_encode($row);
	echo $array_json;
} catch (PDOException $error) {

	echo $error->getMessage();
}
