<?php

include "../../conexion/conexion.php";

try {

	$fecha_inicio = $_GET["fecha_inicio"];
	$fecha_fin = $_GET["fecha_fin"];


	$consulta = $conexion->prepare("SELECT v.id_venta,CONCAT(p.nombre,' ', p.ap_paterno,' ', p.ap_materno)AS cliente,
	dv.estado_pago,v.fecha_venta,dv.total,dv.dinero_descontado,
	CONCAT(pr.producto,' ', t.tipo_miel,' ',f.tamano_frasco,' ','$',pr.precio) AS producto,
	CONCAT(u.ubicacion,' ', a.nombre, ' ', l.fecha_produccion) AS lote,dv.tipo_venta,dv.cantidad,dv.precio
	FROM ventas v

	INNER JOIN detalle_ventas dv ON v.id_venta = dv.id_venta

    INNER JOIN clientes c ON v.id_cliente = c.id_cliente
	INNER JOIN personas p ON c.id_persona = p.id_persona

    INNER JOIN productos pr ON dv.id_producto = pr.id_producto
	INNER JOIN tipos_miel t ON pr.id_tipo_miel = t.id_tipo_miel
	INNER JOIN tamanos_frascos f ON pr.id_tamano_frasco = f.id_tamano_frasco

    INNER JOIN lotes l ON dv.id_lote = l.id_lote
    INNER JOIN ubicaciones u ON l.id_ubicacion = u.id_ubicacion
	INNER JOIN apiarios a ON l.id_apiario = a.id_apiario

	WHERE v.fecha_venta
	BETWEEN '$fecha_inicio' AND '$fecha_fin'");
	$consulta->execute();

	while ($row_reporte = $consulta->fetch(PDO::FETCH_NUM)) {

		if ($row_reporte[2] == "1") {
			$estado_pago = "Pagado";
		}
		else {
			$estado_pago = "Pendiente";
		}

		$renglon = "{
			\"id_venta\":\"$row_reporte[0]\",
			\"id_cliente\":\"$row_reporte[1]\",
			\"estado_pago\":\"$estado_pago\",
			\"fecha_venta\":\"$row_reporte[3]\",
			\"total\":\"$row_reporte[4]\",
			\"dinero_descontado\":\"$row_reporte[5]\",
			\"id_producto\":\"$row_reporte[6]\",
			\"id_lote\":\"$row_reporte[7]\",
			\"tipo_venta\":\"$row_reporte[8]\",
			\"cantidad\":\"$row_reporte[9]\",
			\"precio\":\"$row_reporte[10]\"
		},";

		$cuerpo = $cuerpo . $renglon;
	}

	$cuerpo = trim($cuerpo, ",");
	$tabla = "[" . $cuerpo . "]";

	echo $tabla;
} catch (PDOException $error) {

	echo $error->getMessage();
}
