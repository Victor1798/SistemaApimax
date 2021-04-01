<?php

include "../../conexion/conexion.php";

$id_venta = $_POST['id_venta_cliente'];
$id_cliente = $_POST['id_cliente'];
$fecha_registro = date("y.m.d");
$activo = 1;


try {

	$consulta = $conexion->prepare("INSERT INTO ventas(id_cliente, fecha_venta, fecha_registro, activo)
		VALUES('$id_cliente', '$fecha_registro', '$fecha_registro', '$activo')");

	$mensaje = "Registrado correctamente";

	$consulta->execute();

	echo $mensaje;
} catch (PDOException $error) {

	echo $error->getMessage();
}
