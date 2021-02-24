<?php
include '../../conexion/conexion.php';

$datos = $conexion->prepare("SELECT l.id_lote, u.ubicacion, a.nombre, l.fecha_produccion, l.activo, l.id_ubicacion, l.id_apiario
FROM lotes l
INNER JOIN ubicaciones u ON l.id_ubicacion = u.id_ubicacion
INNER JOIN apiarios a ON l.id_apiario = a.id_apiario
ORDER BY l.id_lote");

try {
    $datos->execute();
    while ($row = $datos->fetch(PDO::FETCH_NUM)) {
        $id_lote = $row[0];
        $id_ubicacion = $row[1];
        $id_apiario = $row[2];
        $fecha_produccion = $row[3];
        $activo = $row[4];
        $estado = ($activo == 1 ? "Activado" : "Desactivado")
?>
        <tr id="lote_<?php echo $id_lote; ?>">
        <input type="hidden" name="id_ubicacion_<?php echo $id_lote; ?>" id="id_ubicacion_<?php echo $id_lote; ?>" value="<?php echo $row[5];?>" >
        <input type="hidden" name="id_apiario_<?php echo $id_lote; ?>" id="id_apiario_<?php echo $id_lote; ?>" value="<?php echo $row[6];?>" >
            <td class="text-center id_lote"><?php echo $id_lote; ?></td>
            <td class="text-center id_ubicacion"><?php echo $id_ubicacion; ?></td>
            <td class="text-center id_apiario"><?php echo $id_apiario; ?></td>
            <td class="text-center fecha_produccion"><?php echo $fecha_produccion; ?></td>
            <td class="text-center"><a href="estado.php?id_lote=<?php echo $id_lote; ?>&estado=<?php echo $activo; ?>" class="btn btn-secondary"><?php echo $estado; ?></a></td>
            <td class="text-center"><a href="javascript:editar(<?php echo $id_lote; ?>)" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a></td>
        </tr>
<?php
    }
} catch (PDOException $error) {
    echo $error->getMessage();
}
?>