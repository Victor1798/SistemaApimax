<?php
declare(strict_types=1);

$servidor = getenv('APIMAX_DB_HOST') ?: '127.0.0.1';
$puerto = getenv('APIMAX_DB_PORT') ?: '3306';
$usuario = getenv('APIMAX_DB_USER') ?: 'root';
$password = getenv('APIMAX_DB_PASSWORD') ?: '';
$base_datos = getenv('APIMAX_DB_NAME') ?: 'apimax';
$dsn = "mysql:host={$servidor};port={$puerto};dbname={$base_datos};charset=utf8mb4";

date_default_timezone_set(getenv('APIMAX_TIMEZONE') ?: 'America/Mexico_City');

try {
    $conexion = new PDO($dsn, $usuario, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $error) {
    error_log('APIMAX database connection failed: ' . $error->getMessage());
    http_response_code(500);
    exit('No fue posible conectar con la base de datos.');
}
