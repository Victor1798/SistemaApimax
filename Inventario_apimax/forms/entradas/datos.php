<?php
include "../../conexion/conexion.php";

try {
	$id_entrada = $_POST["id_entrada"];

	$consulta = $conexion->prepare("SELECT id_entrada, id_producto, id_lote, cantidad, precio, cantidad_disponible, cantidad_vendida, cantidad_desperdiciada, fecha_entrada
	FROM entradas
	WHERE id_entrada = $id_entrada");

	$consulta->execute();
	$row = $consulta->fetch(PDO::FETCH_NUM);

	$array_json = json_encode($row);
	echo $array_json;
} catch (PDOException $error) {

	echo $error->getMessage();
}
