<?php
include '../../conexion/conexion.php';

$datos = $conexion->prepare("SELECT id_usuario, nombre, ap_paterno, ap_materno, fecha_nac, correo, direccion, telefono, usuario, activo FROM usuarios ORDER BY id_usuario");

try
{
    $datos->execute();
    while($row = $datos->fetch(PDO::FETCH_NUM))
    {
        $id_usuario = $row[0];
        $nombre = $row[1];
        $ap_paterno = $row[2];
        $ap_materno = $row[3];
        $fecha_nac = $row[4];
        $correo = $row[5];
        $direccion = $row[6];
        $telefono = $row[7];
        $usuario = $row[8];
        $activo = $row[9];
        $estado = ($activo == 1 ? "Activado":"Desactivado")
        ?>
        <tr id ="usuario_<?php echo $id_usuario;?>">
            <td class="text-center id_usuario"><?php echo $id_usuario;?></td>
            <td class="text-center nombre"><?php echo $nombre;?></td>
            <td class="text-center ap_paterno"><?php echo $ap_paterno;?></td>
            <td class="text-center ap_materno"><?php echo $ap_materno;?></td>
            <td class="text-center fecha_nac"><?php echo $fecha_nac;?></td>
            <td class="text-center correo"><?php echo $correo;?></td>
            <td class="text-center direccion"><?php echo $direccion;?></td> -->
            <td class="text-center telefono"><?php echo $telefono;?></td>
            <td class="text-center usuario"><?php echo $usuario;?></td>
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
