<?php
include '../../conexion/conexion.php';

$datos = $conexion->prepare("SELECT id_tipo_miel, tipo_miel, activo FROM tipos_miel ORDER BY id_tipo_miel");

try {
    $datos->execute();
    while ($row = $datos->fetch(PDO::FETCH_NUM)) {
        $id_tipo_miel = $row[0];
        $tipo_miel = $row[1];
        $activo = $row[2];
        $estado = ($activo == 1 ? "Activado" : "Desactivado")
?>
        <tr id="tipo_miel_<?php echo $id_tipo_miel; ?>">
            <td class="text-center id_tipo_miel"><?php echo $id_tipo_miel; ?></td>
            <td class="text-center tipo_miel"><?php echo $tipo_miel; ?></td>
            <td class="text-center"><a href="estado.php?id_tipo_miel=<?php echo $id_tipo_miel; ?>&estado=<?php echo $activo; ?>" class="btn btn-secondary"><?php echo $estado; ?></a></td>
            <td class="text-center"><a href="javascript:editar(<?php echo $id_tipo_miel; ?>)" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a></td>
        </tr>
<?php
    }
} catch (PDOException $error) {
    echo $error->getMessage();
}
?>