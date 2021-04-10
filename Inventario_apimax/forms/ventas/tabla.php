<?php

include "../../conexion/conexion.php";

try {
	$id_venta = $_GET["id_venta"];

	$consulta = $conexion->prepare("SELECT v.id_detalle_venta, v.id_venta, pr.producto, v.id_lote, v.tipo_venta, v.estado_pago, v.fecha_pago, v.cantidad, v.descuento_pesos, v.descuento_porcen, v.precio, v.total, v.dinero_descontado, v.activo
    FROM detalle_ventas v

    INNER JOIN ventas vn ON v.id_venta = vn.id_venta
    INNER JOIN clientes c ON vn.id_cliente = c.id_cliente
	INNER JOIN personas p ON c.id_persona = p.id_persona
	INNER JOIN productos pr ON v.id_producto = pr.id_producto
    WHERE v.id_venta = '$id_venta'
    ORDER BY v.id_detalle_venta");
	$consulta->execute();

	while ($row_ventas = $consulta->fetch(PDO::FETCH_NUM)) {

		if ($row_ventas[5] == "1") {
			$estado_pago = "<a href='#info_table' class='btn btn-info' title='Estado' onclick='cambiar_estado($row_ventas[0], $row_ventas[5], $row_ventas[1]);' class='btn btn-success' title='Estado'>Pagado</a>";
		} else {
			$estado_pago = "<a href='#info_table' class='btn btn-info' title='Estado' onclick='cambiar_estado($row_ventas[0], $row_ventas[5], $row_ventas[1]);' class='btn btn-danger' title='Estado'>No pagado</a>";
		}

		// $editar = "<a href='#formDetalleVentas' class='btn btn-info' title='Editar' onclick='editar($row_ventas[0]);'><i class='fas fa-pencil-alt'></i></a>";
		$eliminar = "<a href='#' class='btn btn-danger' title='Eliminar' onclick='eliminar($row_ventas[0], $row_ventas[1]);'><i class='fas fa-trash-alt fa-xs'></i></a>";


		$renglon = "{
			\"id_detalle_venta\":\"$row_ventas[0]\",
			\"id_producto\":\"$row_ventas[2]\",
			\"id_lote\":\"$row_ventas[3]\",
			\"tipo_venta\":\"$row_ventas[4]\",
			\"fecha_pago\":\"$row_ventas[6]\",
			\"cantidad\":\"$row_ventas[7]\",
			\"descuento_pesos\":\"$row_ventas[8]\",
			\"descuento_porcen\":\"$row_ventas[9]\",
			\"precio\":\"$row_ventas[10]\",
			\"total\":\"$row_ventas[11]\",
			\"dinero_descontado\":\"$row_ventas[12]\",
			\"estado_pago\":\"$estado_pago\",
			\"eliminar\":\"$eliminar\"

		},";

		$cuerpo = $cuerpo . $renglon;
	}

	$cuerpo = trim($cuerpo, ",");
	$tabla = "[" . $cuerpo . "]";

	echo $tabla;
} catch (PDOException $error) {

	echo $error->getMessage();
}
