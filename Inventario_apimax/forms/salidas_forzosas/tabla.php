<?php

include "../../conexion/conexion.php";

try {

	$consulta = $conexion->prepare("SELECT s.id_desperdicio, p.producto, s.id_lote, s.cantidad_desperdiciada,s.descripcion,s.fecha, s.precio,s.total, s.activo, s.id_producto
    FROM salidas_forzosas s
    INNER JOIN productos p ON s.id_producto = p.id_producto
    ORDER BY s.id_desperdicio");
	$consulta->execute();

	while ($row_salidas = $consulta->fetch(PDO::FETCH_NUM)) {
		if ($row_salidas[8] == 1) {
			$estado = "<a href='estado.php?id_desperdicio=$row_salidas[0]&estado=$row_salidas[8]' class='btn btn-success' title='Estado'>Activo</a>";
		} else {
			$estado = "<a href='estado.php?id_desperdicio=$row_salidas[0]&estado=$row_salidas[8]' class='btn btn-secondary' title='Estado'>Inactivo</a>";
		}

		$editar = "<a href='#' class='btn btn-info' title='Editar' onclick='editar($row_salidas[0]);'><i class='fas fa-pencil-alt'></i></a>";

		$renglon = "{
			\"id_desperdicio\":\"$row_salidas[0]\",
			\"id_producto\":\"$row_salidas[1]\",
			\"id_lote\":\"$row_salidas[2]\",
			\"cantidad_desperdiciada\":\"$row_salidas[3]\",
			\"descripcion\":\"$row_salidas[4]\",
			\"fecha\":\"$row_salidas[5]\",
			\"precio\":\"$row_salidas[6]\",
			\"total\":\"$row_salidas[7]\",
			\"estado\":\"$estado\",
			\"editar\":\"$editar\"
		},";

		$cuerpo = $cuerpo . $renglon;
	}

	$cuerpo = trim($cuerpo, ",");
	$tabla = "[" . $cuerpo . "]";

	echo $tabla;
} catch (PDOException $error) {

	echo $error->getMessage();
}
