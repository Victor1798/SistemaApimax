<?php
include "../../conexion/conexion.php";

try {

	$id_detalle_venta = $_POST["id_detalle_venta"];
	$id_produto = $_POST["id_producto"];
	$id_lote = $_POST["id_lote"];
	$valor_res_entradas = $_POST["valor_res_entradas"];


	$consulta = $conexion->prepare("UPDATE entradas SET cantidad_vendida = cantidad_vendida-'$valor_res_entradas'
	WHERE id_producto = '$id_produto' && id_lote = '$id_lote'");
	$consulta2 = $conexion->prepare("DELETE FROM detalle_ventas WHERE id_detalle_venta = $id_detalle_venta");


	$consulta->execute();
	$consulta2->execute();


	echo "Eliminado correctamente";
} catch (PDOException $error) {

	echo $error->getMessage();
}
