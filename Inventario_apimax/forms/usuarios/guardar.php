<?php
declare(strict_types=1);
require_once '../../conexion/conexion.php';
require_once '../../seguridad/funciones.php';
exigir_sesion('../../index.php');

$id_persona = $_POST['id_persona'];
$usuario = $_POST['usuario'];
$pass = (string) ($_POST['pass'] ?? '');
$tipo_user = $_POST['tipo_user'];

$fecha_registro = date('Y-m-d');

$activo = 1;

try
{
    if ($pass === '' || strlen($pass) < 8) throw new InvalidArgumentException('La contraseña debe tener al menos 8 caracteres.');
    $qry_insert = $conexion->prepare('INSERT INTO usuarios(id_persona, usuario, pass, tipo_usuario, fecha_registro, activo) VALUES(:persona, :usuario, :pass, :tipo, :fecha, :activo)');
    $qry_insert->execute(['persona' => $id_persona, 'usuario' => $usuario, 'pass' => password_hash($pass, PASSWORD_DEFAULT), 'tipo' => $tipo_user, 'fecha' => $fecha_registro, 'activo' => $activo]);
    echo "Nuevo usuario: {$usuario} fue insertado correctamente";
}
catch(Throwable $error)
{
    respuesta_error($error);
}


?>
