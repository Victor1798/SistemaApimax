<?php

include "../../conexion/conexion.php";

$qry = "SELECT id_producto, producto, precio FROM productos WHERE activo = 1";

$datos = $conexion->prepare($qry);
$datosTest = $conexion->prepare($qry);

try {

    $datos->execute();
    $datosTest->execute();
    $rowTest = $datosTest->fetch(PDO::FETCH_NUM);

    if (empty($rowTest) != true) {

        while ($row = $datos->fetch(PDO::FETCH_NUM)) {

            $valorId = $row[0];
            $valorTexto = $row[1];

            $data = $data . '<option value="' . $valorId . '">' . $valorTexto . '</option>' . "\n";
        }

        echo $data;
    } else {

        echo "sin-datos";
    }
} catch (PDOException $error) {

    echo $error->getMessage();
}
