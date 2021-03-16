<?php
include "../../conexion/conexion.php";

try {
	$id_producto = $_POST["id_producto"];

	$consulta = $conexion->prepare("SELECT id_producto, producto, precio FROM productos WHERE id_producto = $id_producto");

	$consulta->execute();
	$row = $consulta->fetch(PDO::FETCH_NUM);

	$array_json = json_encode($row);
	echo $array_json;
} catch (PDOException $error) {

	echo $error->getMessage();
}
