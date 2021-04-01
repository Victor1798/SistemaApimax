<?php

include "../../conexion/conexion.php";

try {

	$fecha_inicio = $_POST["fecha_inicio"];
	$fecha_fin = $_POST["fecha_fin"];


	$consulta = $conexion->prepare("SELECT * FROM entradas WHERE fecha_registro BETWEEN $fecha_inicio AND $fecha_fin
    ORDER BY id_entrada");
	$consulta->execute();

	while ($row_reporte = $consulta->fetch(PDO::FETCH_NUM)) {

		$renglon = "{
			\"id_desperdicio\":\"$row_reporte[0]\",
			\"id_producto\":\"$row_reporte[1]\",
			\"id_lote\":\"$row_reporte[2]\"
		},";

		$cuerpo = $cuerpo . $renglon;
	}

	$cuerpo = trim($cuerpo, ",");
	$tabla = "[" . $cuerpo . "]";

	echo $tabla;
} catch (PDOException $error) {

	echo $error->getMessage();
}
