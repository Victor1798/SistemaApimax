<?php

include "../../conexion/conexion.php";

try {

	$consulta = $conexion->prepare("SELECT e.id_entrada, p.producto, e.id_lote, e.cantidad, e.precio, e.cantidad_disponible, e.cantidad_vendida, e.cantidad_desperdiciada, e.fecha_entrada, e.activo, e.id_producto
    FROM entradas e
    INNER JOIN productos p ON e.id_producto = p.id_producto
    ORDER BY e.id_entrada");
	$consulta->execute();

	while ($row_entradas = $consulta->fetch(PDO::FETCH_NUM))
	{
		if ($row_entradas[9] == 1) {
			$estado = "<a href='estado.php?id_entrada=$row_entradas[0]&estado=$row_entradas[9]' class='btn btn-success' title='Estado'>Activo</a>";
		}
		else {
			$estado = "<a href='estado.php?id_entrada=$row_entradas[0]&estado=$row_entradas[9]' class='btn btn-secondary' title='Estado'>Inactivo</a>";
		}

		$editar = "<a href='#' class='btn btn-info' title='Editar' onclick='editar($row_entradas[0]);'><i class='fas fa-pencil-alt'></i></a>";

		$renglon = "{
			\"id_entrada\":\"$row_entradas[0]\",
			\"id_producto\":\"$row_entradas[1]\",
			\"id_lote\":\"$row_entradas[2]\",
			\"cantidad\":\"$row_entradas[3]\",
			\"precio\":\"$row_entradas[4]\",
			\"cantidad_disponible\":\"$row_entradas[5]\",
            \"cantidad_vendida\":\"$row_entradas[6]\",
			\"cantidad_desperdiciada\":\"$row_entradas[7]\",
			\"fecha_entrada\":\"$row_entradas[8]\",
			\"estado\":\"$estado\",
			\"editar\":\"$editar\"
		},";

		$cuerpo = $cuerpo.$renglon;
	}

	$cuerpo = trim($cuerpo, ",");
	$tabla = "[".$cuerpo."]";

	echo $tabla;

} catch (PDOException $error) {

	echo $error->getMessage();
}