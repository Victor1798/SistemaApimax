<?php
declare(strict_types=1);
require_once '../../conexion/conexion.php';
require_once '../../seguridad/funciones.php';
exigir_sesion('../../index.php');
$id_venta = entero($_POST['id_venta'] ?? null, 'venta');
$total_tabla_descuento = decimal($_POST['total_tabla_descuento'] ?? 0, 'descuento', 0);
$total = decimal($_POST['total'] ?? null, 'total', 0);
$estado_pago = (string) ($_POST['estado_pago'] ?? '');
if (!in_array($estado_pago, ['1', '2'], true)) respuesta_error(new InvalidArgumentException('Estado de pago inválido.'));


try {

	$consulta = $conexion->prepare('UPDATE ventas SET dinero_descontado = :descuento, total = :total, estado_pago = :estado WHERE id_venta = :id');

	$mensaje = "Venta finalizada";

	$consulta->execute(['descuento' => $total_tabla_descuento, 'total' => $total, 'estado' => $estado_pago, 'id' => $id_venta]);


	echo $mensaje;
} catch (Throwable $error) {
	respuesta_error($error);
}
