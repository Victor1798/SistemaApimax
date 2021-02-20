<?php
include '../../conexion/conexion.php';

$datos = $conexion->prepare("SELECT u.id_usuario, CONCAT(p.nombre,' ', p.ap_paterno,' ', p.ap_materno)AS NameFull, u.usuario, u.pass, u.tipo_usuario, u.activo, u.id_persona
FROM usuarios u
INNER JOIN personas p ON u.id_persona = p.id_persona
ORDER BY id_usuario");

try
{
    $datos->execute();
    while($row = $datos->fetch(PDO::FETCH_NUM))
    {
        $id_usuario = $row[0];
        $nombre = $row[1];
        $usuario = $row[2];
        $pass = $row[3];
        $re_pass = $row[3];
        $tipo_user = $row[4];
        $activo = $row[5];
        $estado = ($activo == 1 ? "Activado":"Desactivado")
        ?>
        <tr id ="usuario_<?php echo $id_usuario;?>">
        <input type="hidden" name="id_persona_<?php echo $id_usuario; ?>" id="id_persona_<?php echo $id_usuario; ?>" value="<?php echo $row[6];?>" >
            <td class="text-center id_usuario"><?php echo $id_usuario;?></td>
            <td class="text-center nombre"><?php echo $nombre;?></td>
            <td class="text-center tipo_user"><?php echo $tipo_user;?></td>
            <td class="text-center usuario"><?php echo $usuario;?></td>
            <td class="text-center pass"><?php echo $pass;?></td>
            <td class="text-center re_pass" hidden><?php echo $re_pass;?></td>
            <td class="text-center"><a href="estado.php?id_usuario=<?php echo $id_usuario;?>&estado=<?php echo $activo;?>" class="btn btn-secondary"><?php echo $estado;?></a></td>
            <td class="text-center"><a href="javascript:editar(<?php echo $id_usuario;?>)" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a></td>
        </tr>
        <?php
    }
}
catch(PDOException $error)
{
    echo $error->getMessage();
}
?>
