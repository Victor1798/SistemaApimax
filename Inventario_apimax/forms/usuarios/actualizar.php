<?php
declare(strict_types=1);
require_once '../../conexion/conexion.php';
require_once '../../seguridad/funciones.php';
exigir_sesion('../../index.php');

$id_usuario = $_POST["id_usuario"];
$id_persona = $_POST['id_persona'];
$tipo_user = $_POST['tipo_user'];
$usuario = $_POST['usuario'];
$pass = (string) ($_POST['pass'] ?? '');
$activo = 1;

    try
    {
        if ($pass === '') {
            $qry_update = $conexion->prepare('UPDATE usuarios SET id_persona = :persona, usuario = :usuario, tipo_usuario = :tipo WHERE id_usuario = :id');
            $parametros = ['persona' => $id_persona, 'usuario' => $usuario, 'tipo' => $tipo_user, 'id' => $id_usuario];
        } else {
            if (strlen($pass) < 8) throw new InvalidArgumentException('La contraseña debe tener al menos 8 caracteres.');
            $qry_update = $conexion->prepare('UPDATE usuarios SET id_persona = :persona, usuario = :usuario, pass = :pass, tipo_usuario = :tipo WHERE id_usuario = :id');
            $parametros = ['persona' => $id_persona, 'usuario' => $usuario, 'pass' => password_hash($pass, PASSWORD_DEFAULT), 'tipo' => $tipo_user, 'id' => $id_usuario];
        }

        $qry_update->execute($parametros);
        echo "El usuario {$usuario} fue actualizado correctamente";
    }
    catch(Throwable $error)
    {
        respuesta_error($error);
    }
