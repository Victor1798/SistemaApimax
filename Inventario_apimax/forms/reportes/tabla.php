<?php
declare(strict_types=1);
require_once '../../conexion/conexion.php';
header('Content-Type: application/json; charset=utf-8');

$fechaInicio = $_GET['fecha_inicio'] ?? '';
$fechaFin = $_GET['fecha_fin'] ?? '';

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaInicio) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaFin)) {
    http_response_code(422);
    echo json_encode(['error' => 'El rango de fechas no es válido.']);
    exit;
}

try {
    $consulta = $conexion->prepare("SELECT v.id_venta,
        CONCAT_WS(' ', p.nombre, p.ap_paterno, p.ap_materno) AS cliente,
        dv.estado_pago, v.fecha_venta, dv.total, dv.dinero_descontado,
        CONCAT(pr.producto, ' ', t.tipo_miel, ' ', f.tamano_frasco, ' ', CHAR(36), pr.precio) AS producto,
        CONCAT(u.ubicacion, ' ', a.nombre, ' ', l.fecha_produccion) AS lote,
        dv.tipo_venta, dv.cantidad, dv.precio
        FROM ventas v
        INNER JOIN detalle_ventas dv ON v.id_venta = dv.id_venta
        INNER JOIN clientes c ON v.id_cliente = c.id_cliente
        INNER JOIN personas p ON c.id_persona = p.id_persona
        INNER JOIN productos pr ON dv.id_producto = pr.id_producto
        INNER JOIN tipos_miel t ON pr.id_tipo_miel = t.id_tipo_miel
        INNER JOIN tamanos_frascos f ON pr.id_tamano_frasco = f.id_tamano_frasco
        INNER JOIN lotes l ON dv.id_lote = l.id_lote
        INNER JOIN ubicaciones u ON l.id_ubicacion = u.id_ubicacion
        INNER JOIN apiarios a ON l.id_apiario = a.id_apiario
        WHERE v.fecha_venta BETWEEN :fecha_inicio AND :fecha_fin
        ORDER BY v.id_venta");
    $consulta->execute(['fecha_inicio' => $fechaInicio, 'fecha_fin' => $fechaFin]);

    $datos = [];
    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $datos[] = [
            'id_venta' => (string) $row['id_venta'],
            'id_cliente' => htmlspecialchars((string) $row['cliente'], ENT_QUOTES, 'UTF-8'),
            'estado_pago' => (string) $row['estado_pago'] === '1' ? 'Pagado' : 'Pendiente',
            'fecha_venta' => (string) $row['fecha_venta'],
            'total' => (string) $row['total'],
            'dinero_descontado' => (string) $row['dinero_descontado'],
            'id_producto' => htmlspecialchars((string) $row['producto'], ENT_QUOTES, 'UTF-8'),
            'id_lote' => htmlspecialchars((string) $row['lote'], ENT_QUOTES, 'UTF-8'),
            'tipo_venta' => (string) $row['tipo_venta'],
            'cantidad' => (string) $row['cantidad'],
            'precio' => (string) $row['precio'],
        ];
    }

    echo json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Throwable $error) {
    error_log('APIMAX reportes tabla: ' . $error->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'No fue posible cargar el reporte.']);
}
