<?php

include "../../conexion/conexion.php";

$qry = "SELECT v.id_venta, CONCAT(p.nombre,' ', p.ap_paterno,' ', p.ap_materno)AS NameFull,  v.activo
    FROM ventas v
    INNER JOIN clientes c ON v.id_cliente = c.id_cliente
    INNER JOIN personas p ON c.id_persona = p.id_persona
    ORDER BY v.id_venta desc limit 100000";

$datos = $conexion->prepare($qry);
$datosTest = $conexion->prepare($qry);

try {

    $datos->execute();
    $datosTest->execute();
    $rowTest = $datosTest->fetch(PDO::FETCH_NUM);

    if (empty($rowTest) != true) {

        while ($row = $datos->fetch(PDO::FETCH_NUM)) {

            $valorId = $row[0];
            $valorTexto = $row[0] . " " . $row[1];

            $data = $data . '<option value="' . $valorId . '">' . $valorTexto . '</option>' . "\n";
        }

        echo $data;
    } else {

        echo "sin-datos";
    }
} catch (PDOException $error) {

    echo $error->getMessage();
}
