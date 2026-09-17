<?php
declare(strict_types=1);
require_once '../../conexion/conexion.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $consulta = $conexion->query("SELECT e.id_entrada, p.producto, e.id_lote, e.cantidad, e.precio,
        e.cantidad_disponible, e.cantidad_vendida, e.cantidad_desperdiciada, e.fecha_entrada,
        e.activo, e.id_producto
        FROM entradas e
        INNER JOIN productos p ON e.id_producto = p.id_producto
        ORDER BY e.id_entrada");

    $datos = [];
    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $id = (int) $row['id_entrada'];
        $activo = (int) $row['activo'];
        $estado = $activo === 1 ? 'Activo' : 'Inactivo';
        $clase = $activo === 1 ? 'success' : 'secondary';

        $datos[] = [
            'id_entrada' => (string) $id,
            'id_producto' => htmlspecialchars((string) $row['producto'], ENT_QUOTES, 'UTF-8'),
            'id_lote' => (string) $row['id_lote'],
            'cantidad' => (string) $row['cantidad'],
            'precio' => (string) $row['precio'],
            'cantidad_disponible' => (string) $row['cantidad_disponible'],
            'cantidad_vendida' => (string) $row['cantidad_vendida'],
            'cantidad_desperdiciada' => (string) $row['cantidad_desperdiciada'],
            'fecha_entrada' => (string) $row['fecha_entrada'],
            'estado' => "<a href='estado.php?id_entrada={$id}&estado={$activo}' class='btn btn-{$clase}' title='Estado'>{$estado}</a>",
            'editar' => "<a href='#' class='btn btn-info' title='Editar' onclick='editar({$id}); return false;'><i class='fas fa-pencil-alt'></i></a>",
        ];
    }

    echo json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Throwable $error) {
    error_log('APIMAX entradas tabla: ' . $error->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'No fue posible cargar las entradas.']);
}

