<?php
include "../../conexion/conexion.php";

try {
	$fecha_inicio = $_POST["fecha_inicio"];
	$fecha_fin = $_POST["fecha_fin"];


	$consulta = $conexion->prepare("SELECT SUM(cantidad_desperdiciada) 
	FROM salidas_forzosas 
	WHERE fecha
	BETWEEN '$fecha_inicio' AND '$fecha_fin'");

	$consulta->execute();
	$row = $consulta->fetch(PDO::FETCH_NUM);

	$array_json = json_encode($row);
	echo $array_json;
} catch (PDOException $error) {

	echo $error->getMessage();
}
