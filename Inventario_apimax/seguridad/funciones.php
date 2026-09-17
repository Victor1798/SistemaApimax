<?php
declare(strict_types=1);

function iniciar_sesion_apimax(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) return;
    session_name('apimax');
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax', 'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off']);
    session_start();
}

function exigir_sesion(string $redirect): void
{
    iniciar_sesion_apimax();
    if (($_SESSION['apimax_autenticado'] ?? false) !== true) {
        header('Location: ' . $redirect, true, 302);
        exit;
    }
}

function entrada(string $key, mixed $default = null): mixed
{
    return isset($_POST[$key]) ? (is_string($_POST[$key]) ? trim($_POST[$key]) : $_POST[$key]) : $default;
}

function entero(mixed $value, string $campo): int
{
    $resultado = filter_var($value, FILTER_VALIDATE_INT);
    if ($resultado === false || $resultado < 1) throw new InvalidArgumentException("El campo {$campo} no es válido.");
    return $resultado;
}

function decimal(mixed $value, string $campo, float $minimo = 0): float
{
    if (!is_numeric($value) || (float) $value < $minimo) throw new InvalidArgumentException("El campo {$campo} no es válido.");
    return round((float) $value, 2);
}

function respuesta_error(Throwable $error): never
{
    error_log('APIMAX request failed: ' . $error->getMessage());
    http_response_code(400);
    exit('No fue posible procesar la solicitud.');
}
