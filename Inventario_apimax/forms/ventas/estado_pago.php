<?php
include "../../conexion/conexion.php";

try {

	$id_detalle_venta = $_POST["id_detalle_venta"];
    $estado_pago = $_POST["estado_pago"];

    $nuevo_activo = ($estado_pago == 1 ? 2 : 1);


	$consulta = $conexion->prepare("UPDATE detalle_ventas SET estado_pago = $nuevo_activo WHERE id_detalle_venta = $id_detalle_venta");
	$consulta->execute();

	echo "Actualizado correctamente";
} catch (PDOException $error) {

	echo $error->getMessage();
}
