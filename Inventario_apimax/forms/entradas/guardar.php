<?php

include "../../conexion/conexion.php";

$id_entrada = $_POST['id_entrada'];
$id_producto = $_POST['id_producto'];
$id_lote = $_POST['id_lote'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$fecha_entrada = $_POST['fecha_entrada'];


$fecha_registro = date("y.m.d");

$activo = 1;


try {
	if (empty($id_entrada)) {

		$consulta = $conexion->prepare("INSERT INTO entradas(id_producto, id_lote, cantidad, precio, fecha_entrada, fecha_registro, activo)
		VALUES('$id_producto', '$id_lote', '$cantidad', '$precio', '$fecha_entrada', '$fecha_registro', '$activo')");

		$mensaje = "Registrado correctamente";
	} else {

		$consulta = $conexion->prepare("UPDATE entradas SET id_producto = '$id_producto', id_lote = '$id_lote', cantidad = '$cantidad', precio = '$precio', fecha_entrada = '$fecha_entrada', activo = '$activo'
		WHERE id_entrada = '$id_entrada'");

		$mensaje = "Actualizado correctamente";
	}

	$consulta->execute();
	echo $mensaje;
} catch (PDOException $error) {

	echo $error->getMessage();
}
