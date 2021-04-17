<?php

include "../../conexion/conexion.php";
$id_venta = $_POST['id_venta'];
$total_tabla_descuento = $_POST['total_tabla_descuento'];
$total = $_POST['total'];
$estado_pago =$_POST['estado_pago'];


try {

	$consulta = $conexion->prepare("UPDATE ventas SET dinero_descontado = '$total_tabla_descuento', total = '$total', estado_pago = '$estado_pago'
		WHERE id_venta = '$id_venta'");

	$mensaje = "Venta finalizada";

	$consulta->execute();


	echo $mensaje;
} catch (PDOException $error) {

	echo $error->getMessage();
}
