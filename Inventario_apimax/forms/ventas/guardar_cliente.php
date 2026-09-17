<?php
declare(strict_types=1);
require_once '../../conexion/conexion.php';
require_once '../../seguridad/funciones.php';
exigir_sesion('../../index.php');

$id_cliente = entero($_POST['id_cliente'] ?? null, 'cliente');
$fecha_registro = date('Y-m-d');
$activo = 1;


try {

	$consulta = $conexion->prepare('INSERT INTO ventas(id_cliente, fecha_venta, fecha_registro, activo) VALUES(:cliente, :fecha_venta, :fecha_registro, :activo)');

	$mensaje = "Registrado correctamente";

	$consulta->execute(['cliente' => $id_cliente, 'fecha_venta' => $fecha_registro, 'fecha_registro' => $fecha_registro, 'activo' => $activo]);

	echo $mensaje;
} catch (Throwable $error) {
	respuesta_error($error);
}
