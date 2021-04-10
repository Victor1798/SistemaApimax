<?php

include "../../conexion/conexion.php";
$id_detalle_venta = $_POST['id_detalle_venta'];
$id_venta = $_POST['id_venta'];
$id_producto = $_POST['id_producto'];
$id_lote = $_POST['id_lote'];
$tipo_venta = $_POST['tipo_venta'];
$estado_pago = $_POST['estado_pago'];
$fecha_pago = $_POST['fecha_pago'];
$cantidad = $_POST['cantidad'];
$descuento_pesos = $_POST['descuento_pesos'];
$descuento_porcen = $_POST['descuento_porcen'];

$precio = $_POST['precio'];
$total = $_POST['total'];
$dinero_descontado = $_POST['precio_oculto'];


if ($descuento_pesos == "") {
	$descuento_pesos = 0;
}
if ($descuento_porcen == "") {
	$descuento_porcen = 0;
}

$fecha_registro = date("y.m.d");
$activo = 1;


try {
	if (empty($id_detalle_venta)) {

		$consulta = $conexion->prepare("INSERT INTO detalle_ventas(id_venta, id_producto, id_lote, tipo_venta, estado_pago, fecha_pago, cantidad, descuento_pesos, descuento_porcen, precio, total, dinero_descontado, fecha_registro, activo)
		VALUES('$id_venta', '$id_producto', '$id_lote', '$tipo_venta','$estado_pago', '$fecha_pago','$cantidad','$descuento_pesos','$descuento_porcen', '$precio','$total', $dinero_descontado, '$fecha_registro', '$activo')");

		$consulta2 = $conexion->prepare("UPDATE entradas SET cantidad_vendida = '$cantidad'+cantidad_vendida
		WHERE id_producto = '$id_producto' && id_lote = '$id_lote'");

		// if ($estado_pago == "Pagado") {
		// 	$consulta3 = $conexion->prepare("UPDATE ventas SET estado_pago = '$estado_pago', total = '$total', subtotal = '$total' , pendiente = '0'
		// 	WHERE id_venta = '$id_venta'");
		// 	}
		// else {
		// 	$consulta3 = $conexion->prepare("UPDATE ventas SET estado_pago = '$estado_pago', total = '0', subtotal = '0', pendiente = '$total'
		// 	WHERE id_venta = '$id_venta'");
		// 	}

		$mensaje = "Registrado correctamente";
	} else {

		$consulta = $conexion->prepare("UPDATE detalle_ventas SET id_venta = '$id_venta', id_producto = '$id_producto', id_lote = '$id_lote', tipo_venta = '$tipo_venta', estado_pago = '$estado_pago', fecha_pago = '$fecha_pago', cantidad = '$cantidad', descuento_pesos = '$descuento_pesos', descuento_porcen = '$descuento_porcen', precio = '$precio', total = '$total', dinero_descontado = '$dinero_descontado', activo = '$activo'
		WHERE id_detalle_venta = '$id_detalle_venta'");

		$consulta2 = $conexion->prepare("UPDATE entradas SET cantidad_vendida = '$cantidad'+cantidad_vendida
		WHERE id_producto = '$id_producto' && id_lote = '$id_lote'");

		// if ($estado_pago == "Pagado") {
		// 	$consulta3 = $conexion->prepare("UPDATE ventas SET estado_pago = '$estado_pago', total = '$total', subtotal = '$total' , pendiente = '0'
		// 	WHERE id_venta = '$id_venta'");
		// 	}
		// else {
		// 	$consulta3 = $conexion->prepare("UPDATE ventas SET estado_pago = '$estado_pago', total = '0', subtotal = '0', pendiente = '$total'
		// 	WHERE id_venta = '$id_venta'");
		// 	}
		$mensaje = "Actualizado correctamente";
	}

	$consulta->execute();
	$consulta2->execute();
	// $consulta3->execute();


	echo $mensaje;
} catch (PDOException $error) {

	echo $error->getMessage();
}
