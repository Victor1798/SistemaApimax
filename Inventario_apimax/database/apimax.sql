-- Esquema reconstruido para SistemaApimax.
-- La base original no estaba incluida en el repositorio.
-- Compatible con MySQL 8 y MariaDB 10.5+.

CREATE DATABASE IF NOT EXISTS apimax CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE apimax;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS detalle_ventas;
DROP TABLE IF EXISTS ventas;
DROP TABLE IF EXISTS salidas_forzosas;
DROP TABLE IF EXISTS entradas;
DROP TABLE IF EXISTS lotes;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS tamanos_frascos;
DROP TABLE IF EXISTS tipos_miel;
DROP TABLE IF EXISTS ubicaciones;
DROP TABLE IF EXISTS apiarios;
DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS personas;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE personas (
    id_persona INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(80) NOT NULL,
    ap_paterno VARCHAR(80) NOT NULL,
    ap_materno VARCHAR(80) DEFAULT NULL,
    fecha_nac DATE DEFAULT NULL,
    direccion VARCHAR(255) DEFAULT NULL,
    correo VARCHAR(150) DEFAULT NULL,
    telefono VARCHAR(30) DEFAULT NULL,
    fecha_registro DATE NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    INDEX idx_personas_activo (activo)
) ENGINE=InnoDB;

CREATE TABLE usuarios (
    id_usuario INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_persona INT UNSIGNED NOT NULL,
    usuario VARCHAR(60) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL,
    tipo_usuario VARCHAR(30) NOT NULL DEFAULT 'Empleado',
    fecha_registro DATE NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_usuarios_persona FOREIGN KEY (id_persona) REFERENCES personas (id_persona),
    INDEX idx_usuarios_activo (activo)
) ENGINE=InnoDB;

CREATE TABLE clientes (
    id_cliente INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_persona INT UNSIGNED NOT NULL,
    fecha_registro DATE NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_clientes_persona FOREIGN KEY (id_persona) REFERENCES personas (id_persona),
    INDEX idx_clientes_activo (activo)
) ENGINE=InnoDB;

CREATE TABLE apiarios (
    id_apiario INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    fecha_registro DATE NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE ubicaciones (
    id_ubicacion INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ubicacion VARCHAR(150) NOT NULL,
    fecha_registro DATE NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE tipos_miel (
    id_tipo_miel INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tipo_miel VARCHAR(120) NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE tamanos_frascos (
    id_tamano_frasco INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tamano_frasco VARCHAR(80) NOT NULL,
    fecha_registro DATE NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE productos (
    id_producto INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    producto VARCHAR(150) NOT NULL,
    id_tipo_miel INT UNSIGNED NOT NULL,
    id_tamano_frasco INT UNSIGNED NOT NULL,
    precio DECIMAL(12,2) NOT NULL DEFAULT 0,
    codigo VARCHAR(80) DEFAULT NULL UNIQUE,
    fecha_registro DATE NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_productos_tipo FOREIGN KEY (id_tipo_miel) REFERENCES tipos_miel (id_tipo_miel),
    CONSTRAINT fk_productos_tamano FOREIGN KEY (id_tamano_frasco) REFERENCES tamanos_frascos (id_tamano_frasco),
    INDEX idx_productos_activo (activo)
) ENGINE=InnoDB;

CREATE TABLE lotes (
    id_lote INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_ubicacion INT UNSIGNED NOT NULL,
    id_apiario INT UNSIGNED NOT NULL,
    fecha_produccion DATE NOT NULL,
    fecha_registro DATE NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_lotes_ubicacion FOREIGN KEY (id_ubicacion) REFERENCES ubicaciones (id_ubicacion),
    CONSTRAINT fk_lotes_apiario FOREIGN KEY (id_apiario) REFERENCES apiarios (id_apiario),
    INDEX idx_lotes_activo (activo)
) ENGINE=InnoDB;

CREATE TABLE entradas (
    id_entrada INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_producto INT UNSIGNED NOT NULL,
    id_lote INT UNSIGNED NOT NULL,
    cantidad DECIMAL(12,2) NOT NULL DEFAULT 0,
    precio DECIMAL(12,2) NOT NULL DEFAULT 0,
    cantidad_vendida DECIMAL(12,2) NOT NULL DEFAULT 0,
    cantidad_desperdiciada DECIMAL(12,2) NOT NULL DEFAULT 0,
    cantidad_disponible DECIMAL(12,2) AS (cantidad - cantidad_vendida - cantidad_desperdiciada) STORED,
    fecha_entrada DATE NOT NULL,
    fecha_registro DATE NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_entradas_producto FOREIGN KEY (id_producto) REFERENCES productos (id_producto),
    CONSTRAINT fk_entradas_lote FOREIGN KEY (id_lote) REFERENCES lotes (id_lote),
    INDEX idx_entradas_producto_lote (id_producto, id_lote),
    INDEX idx_entradas_activo (activo)
) ENGINE=InnoDB;

CREATE TABLE ventas (
    id_venta INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT UNSIGNED NOT NULL,
    fecha_venta DATE NOT NULL,
    total DECIMAL(12,2) NOT NULL DEFAULT 0,
    dinero_descontado DECIMAL(12,2) NOT NULL DEFAULT 0,
    estado_pago VARCHAR(10) NOT NULL DEFAULT '2',
    fecha_registro DATE NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_ventas_cliente FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente),
    INDEX idx_ventas_fecha (fecha_venta),
    INDEX idx_ventas_activo (activo)
) ENGINE=InnoDB;

CREATE TABLE detalle_ventas (
    id_detalle_venta INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_venta INT UNSIGNED NOT NULL,
    id_producto INT UNSIGNED NOT NULL,
    id_lote INT UNSIGNED NOT NULL,
    tipo_venta VARCHAR(30) NOT NULL,
    estado_pago VARCHAR(10) NOT NULL DEFAULT '2',
    fecha_pago DATE DEFAULT NULL,
    cantidad DECIMAL(12,2) NOT NULL DEFAULT 0,
    descuento_pesos DECIMAL(12,2) NOT NULL DEFAULT 0,
    descuento_porcen DECIMAL(5,2) NOT NULL DEFAULT 0,
    precio DECIMAL(12,2) NOT NULL DEFAULT 0,
    total DECIMAL(12,2) NOT NULL DEFAULT 0,
    dinero_descontado DECIMAL(12,2) NOT NULL DEFAULT 0,
    fecha_registro DATE NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_detalle_venta FOREIGN KEY (id_venta) REFERENCES ventas (id_venta),
    CONSTRAINT fk_detalle_producto FOREIGN KEY (id_producto) REFERENCES productos (id_producto),
    CONSTRAINT fk_detalle_lote FOREIGN KEY (id_lote) REFERENCES lotes (id_lote),
    INDEX idx_detalle_venta (id_venta),
    INDEX idx_detalle_producto_lote (id_producto, id_lote)
) ENGINE=InnoDB;

CREATE TABLE salidas_forzosas (
    id_desperdicio INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_producto INT UNSIGNED NOT NULL,
    id_lote INT UNSIGNED NOT NULL,
    cantidad_desperdiciada DECIMAL(12,2) NOT NULL DEFAULT 0,
    descripcion VARCHAR(255) DEFAULT NULL,
    fecha DATE NOT NULL,
    precio DECIMAL(12,2) NOT NULL DEFAULT 0,
    total DECIMAL(12,2) NOT NULL DEFAULT 0,
    fecha_registro DATE NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_salidas_producto FOREIGN KEY (id_producto) REFERENCES productos (id_producto),
    CONSTRAINT fk_salidas_lote FOREIGN KEY (id_lote) REFERENCES lotes (id_lote),
    INDEX idx_salidas_producto_lote (id_producto, id_lote)
) ENGINE=InnoDB;

-- No se incluyen credenciales iniciales para evitar publicar contraseñas.
-- Consulta database/README.md para crear el primer usuario con password_hash().
