<?php
include "../../conexion/conexion.php";

try {
	$fecha_inicio = $_POST["fecha_inicio"];
	$fecha_fin = $_POST["fecha_fin"];


	$consulta = $conexion->prepare("SELECT id_producto, producto, precio FROM productos WHERE id_producto = $id_producto");

	$consulta->execute();
	$row = $consulta->fetch(PDO::FETCH_NUM);

	$array_json = json_encode($row);
	echo $array_json;
} catch (PDOException $error) {

	echo $error->getMessage();
}
