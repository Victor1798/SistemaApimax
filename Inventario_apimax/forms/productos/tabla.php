<?php
include '../../conexion/conexion.php';

$datos = $conexion->prepare("SELECT p.id_producto, p.producto, t.tipo_miel, f.tamano_frasco, p.precio, p.activo, p.id_tipo_miel, p.id_tamano_frasco
FROM productos p
INNER JOIN tipos_miel t ON p.id_tipo_miel = t.id_tipo_miel
INNER JOIN tamanos_frascos f ON p.id_tamano_frasco = f.id_tamano_frasco
ORDER BY p.id_producto");

try {
    $datos->execute();
    while ($row = $datos->fetch(PDO::FETCH_NUM)) {
        $id_producto = $row[0];
        $producto = $row[1];
        $id_tipo_miel = $row[2];
        $tamano_frasco = $row[3];
        $precio = $row[4];
        $activo = $row[5];
        $estado = ($activo == 1 ? "Activado" : "Desactivado")
?>
        <tr id="producto_<?php echo $id_producto; ?>">
        <input type="hidden" name="id_tipo_miel_<?php echo $id_producto; ?>" id="id_tipo_miel_<?php echo $id_producto; ?>" value="<?php echo $row[6];?>" >
        <input type="hidden" name="id_tamano_frasco_<?php echo $id_producto; ?>" id="id_tamano_frasco_<?php echo $id_producto; ?>" value="<?php echo $row[7];?>" >

            <td class="text-center id_producto"><?php echo $id_producto; ?></td>
            <td class="text-center producto"><?php echo $producto; ?></td>
            <td class="text-center id_tipo_miel"><?php echo $id_tipo_miel; ?></td>
            <td class="text-center tamano_frasco"><?php echo $tamano_frasco; ?></td>
            <td class="text-center precio"><?php echo $precio; ?></td>
            <td class="text-center"><a href="estado.php?id_producto=<?php echo $id_producto; ?>&estado=<?php echo $activo; ?>" class="btn btn-secondary"><?php echo $estado; ?></a></td>
            <td class="text-center"><a href="javascript:editar(<?php echo $id_producto; ?>)" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a></td>
        </tr>
<?php
    }
} catch (PDOException $error) {
    echo $error->getMessage();
}
?>