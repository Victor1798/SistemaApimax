<?php
declare(strict_types=1);
require_once '../../conexion/conexion.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $consulta = $conexion->query("SELECT s.id_desperdicio, p.producto, s.id_lote,
        s.cantidad_desperdiciada, s.descripcion, s.fecha, s.precio, s.total,
        s.activo, s.id_producto
        FROM salidas_forzosas s
        INNER JOIN productos p ON s.id_producto = p.id_producto
        ORDER BY s.id_desperdicio");

    $datos = [];
    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $id = (int) $row['id_desperdicio'];
        $activo = (int) $row['activo'];
        $estado = $activo === 1 ? 'Activo' : 'Inactivo';
        $clase = $activo === 1 ? 'success' : 'secondary';

        $datos[] = [
            'id_desperdicio' => (string) $id,
            'id_producto' => htmlspecialchars((string) $row['producto'], ENT_QUOTES, 'UTF-8'),
            'id_lote' => (string) $row['id_lote'],
            'cantidad_desperdiciada' => (string) $row['cantidad_desperdiciada'],
            'descripcion' => htmlspecialchars((string) ($row['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'fecha' => (string) $row['fecha'],
            'precio' => (string) $row['precio'],
            'total' => (string) $row['total'],
            'estado' => "<a href='estado.php?id_desperdicio={$id}&estado={$activo}' class='btn btn-{$clase}' title='Estado'>{$estado}</a>",
            'editar' => "<a href='#' class='btn btn-info' title='Editar' onclick='editar({$id}); return false;'><i class='fas fa-pencil-alt'></i></a>",
        ];
    }

    echo json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Throwable $error) {
    error_log('APIMAX salidas tabla: ' . $error->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'No fue posible cargar las salidas.']);
}

