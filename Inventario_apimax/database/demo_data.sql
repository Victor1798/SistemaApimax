-- Datos de demostración para validar el sistema.
-- Puede ejecutarse después de apimax.sql sin borrar información existente.
USE apimax;

INSERT INTO tipos_miel (tipo_miel, activo)
SELECT 'Multifloral', 1 WHERE NOT EXISTS (SELECT 1 FROM tipos_miel WHERE tipo_miel = 'Multifloral');
INSERT INTO tipos_miel (tipo_miel, activo)
SELECT 'Mezquite', 1 WHERE NOT EXISTS (SELECT 1 FROM tipos_miel WHERE tipo_miel = 'Mezquite');
INSERT INTO tipos_miel (tipo_miel, activo)
SELECT 'Azahar', 1 WHERE NOT EXISTS (SELECT 1 FROM tipos_miel WHERE tipo_miel = 'Azahar');

INSERT INTO tamanos_frascos (tamano_frasco, fecha_registro, activo)
SELECT '250 g', CURRENT_DATE, 1 WHERE NOT EXISTS (SELECT 1 FROM tamanos_frascos WHERE tamano_frasco = '250 g');
INSERT INTO tamanos_frascos (tamano_frasco, fecha_registro, activo)
SELECT '500 g', CURRENT_DATE, 1 WHERE NOT EXISTS (SELECT 1 FROM tamanos_frascos WHERE tamano_frasco = '500 g');
INSERT INTO tamanos_frascos (tamano_frasco, fecha_registro, activo)
SELECT '1 kg', CURRENT_DATE, 1 WHERE NOT EXISTS (SELECT 1 FROM tamanos_frascos WHERE tamano_frasco = '1 kg');

INSERT INTO apiarios (nombre, fecha_registro, activo)
SELECT 'Apiario La Colmena', CURRENT_DATE, 1 WHERE NOT EXISTS (SELECT 1 FROM apiarios WHERE nombre = 'Apiario La Colmena');
INSERT INTO apiarios (nombre, fecha_registro, activo)
SELECT 'Apiario El Encino', CURRENT_DATE, 1 WHERE NOT EXISTS (SELECT 1 FROM apiarios WHERE nombre = 'Apiario El Encino');

INSERT INTO ubicaciones (ubicacion, fecha_registro, activo)
SELECT 'Almacén principal', CURRENT_DATE, 1 WHERE NOT EXISTS (SELECT 1 FROM ubicaciones WHERE ubicacion = 'Almacén principal');
INSERT INTO ubicaciones (ubicacion, fecha_registro, activo)
SELECT 'Cámara fría', CURRENT_DATE, 1 WHERE NOT EXISTS (SELECT 1 FROM ubicaciones WHERE ubicacion = 'Cámara fría');
INSERT INTO ubicaciones (ubicacion, fecha_registro, activo)
SELECT 'Punto de venta', CURRENT_DATE, 1 WHERE NOT EXISTS (SELECT 1 FROM ubicaciones WHERE ubicacion = 'Punto de venta');

SELECT id_tipo_miel INTO @miel_multifloral FROM tipos_miel WHERE tipo_miel = 'Multifloral' LIMIT 1;
SELECT id_tipo_miel INTO @miel_mezquite FROM tipos_miel WHERE tipo_miel = 'Mezquite' LIMIT 1;
SELECT id_tipo_miel INTO @miel_azahar FROM tipos_miel WHERE tipo_miel = 'Azahar' LIMIT 1;
SELECT id_tamano_frasco INTO @frasco_250 FROM tamanos_frascos WHERE tamano_frasco = '250 g' LIMIT 1;
SELECT id_tamano_frasco INTO @frasco_500 FROM tamanos_frascos WHERE tamano_frasco = '500 g' LIMIT 1;
SELECT id_tamano_frasco INTO @frasco_1kg FROM tamanos_frascos WHERE tamano_frasco = '1 kg' LIMIT 1;

INSERT INTO productos (producto, id_tipo_miel, id_tamano_frasco, precio, codigo, fecha_registro, activo)
SELECT 'Miel multifloral 250 g', @miel_multifloral, @frasco_250, 95.00, '750000000001', CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM productos WHERE codigo = '750000000001');
INSERT INTO productos (producto, id_tipo_miel, id_tamano_frasco, precio, codigo, fecha_registro, activo)
SELECT 'Miel multifloral 500 g', @miel_multifloral, @frasco_500, 170.00, '750000000002', CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM productos WHERE codigo = '750000000002');
INSERT INTO productos (producto, id_tipo_miel, id_tamano_frasco, precio, codigo, fecha_registro, activo)
SELECT 'Miel de mezquite 1 kg', @miel_mezquite, @frasco_1kg, 290.00, '750000000003', CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM productos WHERE codigo = '750000000003');
INSERT INTO productos (producto, id_tipo_miel, id_tamano_frasco, precio, codigo, fecha_registro, activo)
SELECT 'Miel de azahar 500 g', @miel_azahar, @frasco_500, 185.00, '750000000004', CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM productos WHERE codigo = '750000000004');

SELECT id_apiario INTO @apiario_colmena FROM apiarios WHERE nombre = 'Apiario La Colmena' LIMIT 1;
SELECT id_apiario INTO @apiario_encino FROM apiarios WHERE nombre = 'Apiario El Encino' LIMIT 1;
SELECT id_ubicacion INTO @ubicacion_almacen FROM ubicaciones WHERE ubicacion = 'Almacén principal' LIMIT 1;
SELECT id_ubicacion INTO @ubicacion_frio FROM ubicaciones WHERE ubicacion = 'Cámara fría' LIMIT 1;

INSERT INTO lotes (id_ubicacion, id_apiario, fecha_produccion, fecha_registro, activo)
SELECT @ubicacion_almacen, @apiario_colmena, DATE_SUB(CURRENT_DATE, INTERVAL 20 DAY), CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM lotes WHERE id_ubicacion = @ubicacion_almacen AND id_apiario = @apiario_colmena AND fecha_produccion = DATE_SUB(CURRENT_DATE, INTERVAL 20 DAY));
INSERT INTO lotes (id_ubicacion, id_apiario, fecha_produccion, fecha_registro, activo)
SELECT @ubicacion_frio, @apiario_encino, DATE_SUB(CURRENT_DATE, INTERVAL 8 DAY), CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM lotes WHERE id_ubicacion = @ubicacion_frio AND id_apiario = @apiario_encino AND fecha_produccion = DATE_SUB(CURRENT_DATE, INTERVAL 8 DAY));

INSERT INTO personas (nombre, ap_paterno, ap_materno, correo, telefono, fecha_registro, activo)
SELECT 'Mariana', 'Gómez', 'López', 'mariana.demo@apimax.local', '5551001001', CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM personas WHERE correo = 'mariana.demo@apimax.local');
INSERT INTO personas (nombre, ap_paterno, ap_materno, correo, telefono, fecha_registro, activo)
SELECT 'Carlos', 'Ramírez', 'Soto', 'carlos.demo@apimax.local', '5551001002', CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM personas WHERE correo = 'carlos.demo@apimax.local');
INSERT INTO personas (nombre, ap_paterno, ap_materno, correo, telefono, fecha_registro, activo)
SELECT 'Ana', 'Martínez', 'Ruiz', 'ana.cliente@apimax.local', '5551001003', CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM personas WHERE correo = 'ana.cliente@apimax.local');
INSERT INTO personas (nombre, ap_paterno, ap_materno, correo, telefono, fecha_registro, activo)
SELECT 'Luis', 'Hernández', 'Díaz', 'luis.cliente@apimax.local', '5551001004', CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM personas WHERE correo = 'luis.cliente@apimax.local');

SELECT id_persona INTO @persona_cliente_ana FROM personas WHERE correo = 'ana.cliente@apimax.local' LIMIT 1;
SELECT id_persona INTO @persona_cliente_luis FROM personas WHERE correo = 'luis.cliente@apimax.local' LIMIT 1;

INSERT INTO clientes (id_persona, fecha_registro, activo)
SELECT @persona_cliente_ana, CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM clientes WHERE id_persona = @persona_cliente_ana);
INSERT INTO clientes (id_persona, fecha_registro, activo)
SELECT @persona_cliente_luis, CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM clientes WHERE id_persona = @persona_cliente_luis);

SELECT id_producto INTO @producto_250 FROM productos WHERE codigo = '750000000001' LIMIT 1;
SELECT id_producto INTO @producto_500 FROM productos WHERE codigo = '750000000002' LIMIT 1;
SELECT id_producto INTO @producto_1kg FROM productos WHERE codigo = '750000000003' LIMIT 1;
SELECT id_producto INTO @producto_azahar FROM productos WHERE codigo = '750000000004' LIMIT 1;
SELECT id_lote INTO @lote_1 FROM lotes ORDER BY id_lote LIMIT 1;
SELECT id_lote INTO @lote_2 FROM lotes ORDER BY id_lote DESC LIMIT 1;

INSERT INTO entradas (id_producto, id_lote, cantidad, precio, fecha_entrada, fecha_registro, activo)
SELECT @producto_250, @lote_1, 80, 60.00, CURRENT_DATE, CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM entradas WHERE id_producto = @producto_250 AND id_lote = @lote_1);
INSERT INTO entradas (id_producto, id_lote, cantidad, precio, fecha_entrada, fecha_registro, activo)
SELECT @producto_500, @lote_1, 60, 105.00, CURRENT_DATE, CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM entradas WHERE id_producto = @producto_500 AND id_lote = @lote_1);
INSERT INTO entradas (id_producto, id_lote, cantidad, precio, fecha_entrada, fecha_registro, activo)
SELECT @producto_1kg, @lote_2, 35, 180.00, CURRENT_DATE, CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM entradas WHERE id_producto = @producto_1kg AND id_lote = @lote_2);
INSERT INTO entradas (id_producto, id_lote, cantidad, precio, fecha_entrada, fecha_registro, activo)
SELECT @producto_azahar, @lote_2, 45, 115.00, CURRENT_DATE, CURRENT_DATE, 1
WHERE NOT EXISTS (SELECT 1 FROM entradas WHERE id_producto = @producto_azahar AND id_lote = @lote_2);
