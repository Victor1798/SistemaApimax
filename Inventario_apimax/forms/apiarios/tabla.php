<?php
include '../../conexion/conexion.php';

$datos = $conexion->prepare("SELECT id_apiario, nombre, activo FROM apiarios ORDER BY id_apiario");

try {
    $datos->execute();
    while ($row = $datos->fetch(PDO::FETCH_NUM)) {
        $id_apiario = $row[0];
        $nombre = $row[1];
        $activo = $row[2];
        $estado = ($activo == 1 ? "Activado" : "Desactivado")
?>
        <tr id="nombre_<?php echo $id_apiario; ?>">
            <td class="text-center id_apiario"><?php echo $id_apiario; ?></td>
            <td class="text-center nombre"><?php echo $nombre; ?></td>
            <td class="text-center"><a href="estado.php?id_apiario=<?php echo $id_apiario; ?>&estado=<?php echo $activo; ?>" class="btn btn-secondary"><?php echo $estado; ?></a></td>
            <td class="text-center"><a href="javascript:editar(<?php echo $id_apiario; ?>)" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a></td>
        </tr>
<?php
    }
} catch (PDOException $error) {
    echo $error->getMessage();
}
?>