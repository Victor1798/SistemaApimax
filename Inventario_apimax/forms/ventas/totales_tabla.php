<?php
include "../../conexion/conexion.php";

try {
	$id_venta = $_POST["id_venta"];

	$consulta = $conexion->prepare("SELECT SUM(dinero_descontado), SUM(total), (SELECT COUNT(estado_pago) FROM detalle_ventas WHERE id_venta = '$id_venta' AND estado_pago = '2')
    FROM detalle_ventas
    WHERE id_venta = '$id_venta'");

	$consulta->execute();
	$row = $consulta->fetch(PDO::FETCH_NUM);

	$array_json = json_encode($row);
	echo $array_json;
} catch (PDOException $error) {

	echo $error->getMessage();
}
