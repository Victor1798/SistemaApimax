<?php
include '../../conexion/conexion.php';

$datos = $conexion->prepare("SELECT id_ubicacion, ubicacion, activo FROM ubicaciones ORDER BY id_ubicacion");

try {
    $datos->execute();
    while ($row = $datos->fetch(PDO::FETCH_NUM)) {
        $id_ubicacion = $row[0];
        $ubicacion= $row[1];
        $activo = $row[2];
        $estado = ($activo == 1 ? "Activado" : "Desactivado")
?>
        <tr id="ubicacion_<?php echo $id_ubicacion; ?>">
            <td class="text-center id_ubicacion"><?php echo $id_ubicacion; ?></td>
            <td class="text-center ubicacion"><?php echo $ubicacion; ?></td>
            <td class="text-center"><a href="estado.php?id_ubicacion=<?php echo $id_ubicacion; ?>&estado=<?php echo $activo; ?>" class="btn btn-secondary"><?php echo $estado; ?></a></td>
            <td class="text-center"><a href="javascript:editar(<?php echo $id_ubicacion; ?>)" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a></td>
        </tr>
<?php
    }
} catch (PDOException $error) {
    echo $error->getMessage();
}
?>