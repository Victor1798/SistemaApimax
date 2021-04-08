<?php

include "../../conexion/conexion.php";

try {

	$fecha_inicio = $_GET["fecha_inicio"];
	$fecha_fin = $_GET["fecha_fin"];


	$consulta = $conexion->prepare("SELECT * FROM ventas INNER JOIN detalle_ventas ON ventas.id_venta = detalle_ventas.id_detalle_venta
	WHERE ventas.fecha_venta
	BETWEEN '$fecha_inicio' AND '$fecha_fin'");
	$consulta->execute();

	while ($row_reporte = $consulta->fetch(PDO::FETCH_NUM)) {

		$renglon = "{
			\"id_venta\":\"$row_reporte[0]\",
			\"id_cliente\":\"$row_reporte[1]\",
			\"estado_pago\":\"$row_reporte[2]\",
			\"fecha_venta\":\"$row_reporte[3]\",
			\"total\":\"$row_reporte[4]\",
			\"dinero_descontado\":\"$row_reporte[5]\",
			\"pendiente\":\"$row_reporte[6]\",
			\"fecha_registro\":\"$row_reporte[7]\",
			\"activo\":\"$row_reporte[8]\",
			\"id_detalle_venta\":\"$row_reporte[9]\",
			\"id_venta\":\"$row_reporte[10]\",
			\"id_producto\":\"$row_reporte[11]\",
			\"id_lote\":\"$row_reporte[12]\",
			\"tipo_venta\":\"$row_reporte[13]\",
			\"estado_pago\":\"$row_reporte[14]\",
			\"fecha_pago\":\"$row_reporte[15]\",
			\"cantidad\":\"$row_reporte[16]\",
			\"descuento\":\"$row_reporte[17]\",
			\"precio\":\"$row_reporte[18]\",
			\"fecha_registro\":\"$row_reporte[19]\",
			\"activo\":\"$row_reporte[20]\"
		},";

		$cuerpo = $cuerpo . $renglon;
	}

	$cuerpo = trim($cuerpo, ",");
	$tabla = "[" . $cuerpo . "]";

	echo $tabla;
} catch (PDOException $error) {

	echo $error->getMessage();
}
