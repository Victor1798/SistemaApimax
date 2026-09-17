<?php
declare(strict_types=1);
require_once '../../conexion/conexion.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $consulta = $conexion->query("SELECT v.id_venta,
        CONCAT(p.nombre, ' ', p.ap_paterno, ' ', p.ap_materno) AS cliente,
        v.estado_pago, v.fecha_venta, v.total, v.dinero_descontado
        FROM ventas v
        INNER JOIN clientes c ON v.id_cliente = c.id_cliente
        INNER JOIN personas p ON c.id_persona = p.id_persona
        ORDER BY v.id_venta");

    $datos = [];
    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $id = (int) $row['id_venta'];
        $estadoPago = (string) $row['estado_pago'];

        if ($estadoPago === '1' || $estadoPago === '0') {
            $texto = 'Pagado';
            $clase = 'success';
        } elseif ($estadoPago === '') {
            $texto = 'Incompleto';
            $clase = 'secondary';
        } else {
            $texto = 'Pendiente';
            $clase = 'warning';
        }

        $cliente = htmlspecialchars((string) $row['cliente'], ENT_QUOTES, 'UTF-8');
        $estado = "<a type='button' data-toggle='modal' data-target='.modal_detalles' href='#' onclick='cargar_detalles({$id}); return false;' class='btn btn-{$clase}' title='Estado'>{$texto}</a>";

        $datos[] = [
            'id_venta' => (string) $id,
            'id_cliente' => $cliente,
            'fecha_venta' => (string) $row['fecha_venta'],
            'total' => (string) $row['total'],
            'dinero_descontado' => (string) $row['dinero_descontado'],
            'estado' => $estado,
        ];
    }

    echo json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Throwable $error) {
    error_log('APIMAX seguimiento ventas tabla: ' . $error->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'No fue posible cargar el seguimiento de ventas.']);
}

