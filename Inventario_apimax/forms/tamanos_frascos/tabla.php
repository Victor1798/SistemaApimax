<?php
include '../../conexion/conexion.php';

$datos = $conexion->prepare("SELECT id_tamano_frasco, tamano_frasco, activo FROM tamanos_frascos ORDER BY id_tamano_frasco");

try {
    $datos->execute();
    while ($row = $datos->fetch(PDO::FETCH_NUM)) {
        $id_tamano_frasco = $row[0];
        $tamano_frasco= $row[1];
        $activo = $row[2];
        $estado = ($activo == 1 ? "Activado" : "Desactivado")
?>
        <tr id="tamano_frasco_<?php echo $id_tamano_frasco; ?>">
            <td class="text-center id_tamano_frasco"><?php echo $id_tamano_frasco; ?></td>
            <td class="text-center tamano_frasco"><?php echo $tamano_frasco; ?></td>
            <td class="text-center"><a href="estado.php?id_tamano_frasco=<?php echo $id_tamano_frasco; ?>&estado=<?php echo $activo; ?>" class="btn btn-secondary"><?php echo $estado; ?></a></td>
            <td class="text-center"><a href="javascript:editar(<?php echo $id_tamano_frasco; ?>)" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a></td>
        </tr>
<?php
    }
} catch (PDOException $error) {
    echo $error->getMessage();
}
?>