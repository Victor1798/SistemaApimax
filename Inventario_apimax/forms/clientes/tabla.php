<?php
include '../../conexion/conexion.php';

$datos = $conexion->prepare("SELECT c.id_cliente, CONCAT(p.nombre,' ', p.ap_paterno,' ', p.ap_materno)AS NameFull,  c.activo, c.id_persona
FROM clientes c
INNER JOIN personas p ON c.id_persona = p.id_persona
ORDER BY id_cliente");

try
{
    $datos->execute();
    while($row = $datos->fetch(PDO::FETCH_NUM))
    {
        $id_cliente = $row[0];
        $nombre = $row[1];
        $activo = $row[2];
        $estado = ($activo == 1 ? "Activado":"Desactivado")
        ?>
        <tr id ="cliente_<?php echo $id_cliente;?>">
        <input type="hidden" name="id_persona_<?php echo $id_cliente; ?>" id="id_persona_<?php echo $id_cliente; ?>" value="<?php echo $row[3];?>" >
            <td class="text-center id_cliente"><?php echo $id_cliente;?></td>
            <td class="text-center nombre"><?php echo $nombre;?></td>
            <td class="text-center"><a href="estado.php?id_cliente=<?php echo $id_cliente;?>&estado=<?php echo $activo;?>" class="btn btn-secondary"><?php echo $estado;?></a></td>
            <td class="text-center"><a href="javascript:editar(<?php echo $id_cliente;?>)" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a></td>
        </tr>
        <?php
    }
}
catch(PDOException $error)
{
    echo $error->getMessage();
}
?>
