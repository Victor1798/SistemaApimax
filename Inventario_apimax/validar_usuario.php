<?php
declare(strict_types=1);

require_once __DIR__ . '/conexion/conexion.php';
require_once __DIR__ . '/seguridad/funciones.php';
iniciar_sesion_apimax();

$usuario = trim((string) ($_POST['nombre_usuario'] ?? ''));
$contrasena = (string) ($_POST['pass'] ?? '');
if ($usuario === '' || $contrasena === '') { http_response_code(422); exit('1'); }

try {
    $consulta = $conexion->prepare("SELECT u.id_usuario, CONCAT_WS(' ', p.nombre, p.ap_paterno, p.ap_materno) AS nombre_completo, u.usuario, u.pass, u.tipo_usuario FROM usuarios u INNER JOIN personas p ON u.id_persona = p.id_persona WHERE u.usuario = :usuario AND u.activo = 1 LIMIT 1");
    $consulta->execute(['usuario' => $usuario]);
    $fila = $consulta->fetch();
    $valida = $fila && (password_verify($contrasena, (string) $fila['pass']) || hash_equals((string) $fila['pass'], $contrasena));
    if (!$valida) exit('1');

    session_regenerate_id(true);
    $_SESSION['apimax_id_usuario'] = (int) $fila['id_usuario'];
    $_SESSION['apimax_nombre_persona'] = $fila['nombre_completo'];
    $_SESSION['apimax_usuario'] = $fila['usuario'];
    $_SESSION['apimax_tipo_usuario'] = $fila['tipo_usuario'];
    $_SESSION['apimax_autenticado'] = true;

    if (!password_get_info((string) $fila['pass'])['algo']) {
        $actualizar = $conexion->prepare('UPDATE usuarios SET pass = :pass WHERE id_usuario = :id');
        $actualizar->execute(['pass' => password_hash($contrasena, PASSWORD_DEFAULT), 'id' => $fila['id_usuario']]);
    }
    echo '2';
} catch (Throwable $error) {
    error_log('APIMAX login failed: ' . $error->getMessage());
    http_response_code(500);
    echo '0';
}
