<?php
include "../../conexion/conexion.php";

try {
	$id_desperdicio = $_POST["id_desperdicio"];

	$consulta = $conexion->prepare("SELECT id_desperdicio, id_producto, id_lote, cantidad_desperdiciada,descripcion,fecha, precio,total 
	FROM salidas_forzosas
	WHERE id_desperdicio = $id_desperdicio");

	$consulta->execute();
	$row = $consulta->fetch(PDO::FETCH_NUM);

	$array_json = json_encode($row);
	echo $array_json;
} catch (PDOException $error) {

	echo $error->getMessage();
}
