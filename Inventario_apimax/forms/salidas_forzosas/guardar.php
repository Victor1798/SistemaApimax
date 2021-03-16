<?php

include "../../conexion/conexion.php";

$id_desperdicio = $_POST['id_desperdicio'];
$id_producto = $_POST['id_producto'];
$id_lote = $_POST['id_lote'];
$cantidad_desperdiciada = $_POST['cantidad_desperdiciada'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$precio = $_POST['precio'];
$total = $_POST['total'];
$fecha_registro = date("y.m.d");
$activo = 1;


try {
	if (empty($id_desperdicio)) {

		$consulta = $conexion->prepare("INSERT INTO salidas_forzosas(id_producto, id_lote, cantidad_desperdiciada, descripcion, fecha, precio, total, fecha_registro, activo)
		VALUES('$id_producto', '$id_lote', '$cantidad_desperdiciada','$descripcion', '$fecha','$precio','$total' , '$fecha_registro', '$activo')");

		$consulta2 = $conexion->prepare("UPDATE entradas SET cantidad_desperdiciada = '$cantidad_desperdiciada'
		WHERE id_producto = '$id_producto' && id_lote = '$id_lote'");

		$mensaje = "Registrado correctamente";
	} else {

		$consulta = $conexion->prepare("UPDATE salidas_forzosas SET id_producto = '$id_producto', id_lote = '$id_lote', cantidad_desperdiciada = '$cantidad_desperdiciada',descripcion = '$descripcion',fecha = '$fecha', precio = '$precio', total = '$total', activo = '$activo'
		WHERE id_desperdicio = '$id_desperdicio'");

		$consulta2 = $conexion->prepare("UPDATE entradas SET cantidad_desperdiciada = '$cantidad_desperdiciada'
		WHERE id_producto = '$id_producto' && id_lote = '$id_lote'");

		$mensaje = "Actualizado correctamente";
	}

	$consulta->execute();
	$consulta2->execute();

	echo $mensaje;
} catch (PDOException $error) {

	echo $error->getMessage();
}
