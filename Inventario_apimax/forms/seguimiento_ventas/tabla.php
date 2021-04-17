<?php
include "../../conexion/conexion.php";

try {

	$consulta = $conexion->prepare("SELECT v.id_venta, CONCAT(p.nombre,' ', p.ap_paterno,' ',p.ap_materno), v.estado_pago, v.fecha_venta, v.total, v.dinero_descontado
    FROM ventas v
    INNER JOIN clientes c ON v.id_cliente = c.id_cliente
	INNER JOIN personas p ON c.id_persona = p.id_persona
    ORDER BY v.id_venta");
	$consulta->execute();

	while ($row_ventas = $consulta->fetch(PDO::FETCH_NUM)) {
		if ($row_ventas[2] == "0") {
			$estado = "<a type='button' data-toggle='modal' data-target='.modal_detalles' href='#' onclick='cargar_detalles($row_ventas[0]);' class='btn btn-success' title='Estado'>Pagado</a>";
		}elseif ($row_ventas[2] == "") {
			$estado = "<a type='button' data-toggle='modal' data-target='.modal_detalles' href='#' onclick='cargar_detalles($row_ventas[0]);' class='btn btn-secondary' title='Estado'>Incompleto</a>";
		}
		else {
			$estado = "<a type='button' data-toggle='modal' data-target='.modal_detalles' href='#' onclick='cargar_detalles($row_ventas[0]);' class='btn btn-warning' title='Estado'>Pendiente</a>";
		}
		$renglon = "{
			\"id_venta\":\"$row_ventas[0]\",
			\"id_cliente\":\"$row_ventas[1]\",
			\"fecha_venta\":\"$row_ventas[3]\",
			\"total\":\"$row_ventas[4]\",
			\"dinero_descontado\":\"$row_ventas[5]\",
			\"estado\":\"$estado\"
		},";
		$cuerpo = $cuerpo . $renglon;
	}
	$cuerpo = trim($cuerpo, ",");
	$tabla = "[" . $cuerpo . "]";

	echo $tabla;
} catch (PDOException $error) {

	echo $error->getMessage();
}
