<?php

include "../../conexion/conexion.php";

try {

	$fecha_inicio = $_GET["fecha_inicio"];
	$fecha_fin = $_GET["fecha_fin"];

	$consulta = $conexion->prepare("SELECT e.id_entrada, p.producto, e.id_lote, e.cantidad, e.precio, e.cantidad_disponible, e.cantidad_vendida, e.cantidad_desperdiciada, e.fecha_entrada, e.activo, e.id_producto
    FROM entradas e
    INNER JOIN productos p ON e.id_producto = p.id_producto
	WHERE e.fecha_entrada
	ORDER BY e.id_entrada
    BETWEEN '$fecha_inicio' AND '$fecha_fin'");
	$consulta->execute();

	while ($row_entradas = $consulta->fetch(PDO::FETCH_NUM))

	{
		$res1 = $row_entradas[6]+$row_entradas[7];
		$resultado = $row_entradas[3] - $res1;
		

		$renglon = "{
			\"id_entrada\":\"$row_entradas[0]\",
			\"id_producto\":\"$row_entradas[1]\",
			\"id_lote\":\"$row_entradas[2]\",
			\"cantidad\":\"$row_entradas[3]\",
			\"precio\":\"$row_entradas[4]\",
			\"cantidad_disponible\":\"$resultado\",
            \"cantidad_vendida\":\"$row_entradas[6]\",
			\"cantidad_desperdiciada\":\"$row_entradas[7]\",
			\"fecha_entrada\":\"$row_entradas[8]\",
		},";

		$cuerpo = $cuerpo.$renglon;
	}

	$cuerpo = trim($cuerpo, ",");
	$tabla = "[".$cuerpo."]";

	echo $tabla;

} catch (PDOException $error) {

	echo $error->getMessage();
}