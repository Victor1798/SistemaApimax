<?php
include "../../conexion/conexion.php";

try {

	$id_detalle_venta = $_POST["id_detalle_venta"];

	$consulta = $conexion->prepare("DELETE FROM detalle_ventas WHERE id_detalle_venta = $id_detalle_venta");
	$consulta->execute();

	echo "Eliminado correctamente";
} catch (PDOException $error) {

	echo $error->getMessage();
}
