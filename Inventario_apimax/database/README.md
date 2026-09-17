# Preparar el usuario inicial

El esquema no crea una contrasena predeterminada. Genera un hash desde la terminal de Codespaces:

```bash
php -r 'echo password_hash("TU_CLAVE_SEGURA", PASSWORD_DEFAULT), PHP_EOL;'
```

Copia el resultado y ejecutalo en MySQL reemplazando `HASH_GENERADO`:

```sql
USE apimax;

INSERT INTO personas (nombre, ap_paterno, fecha_registro, activo)
VALUES ('Administrador', 'APIMAX', CURRENT_DATE, 1);

SET @persona_id = LAST_INSERT_ID();

INSERT INTO usuarios (id_persona, usuario, pass, tipo_usuario, fecha_registro, activo)
VALUES (@persona_id, 'admin', 'HASH_GENERADO', 'Administrador', CURRENT_DATE, 1);
```

Despues inicia sesion con el usuario `admin` y la contrasena que elegiste.

## Datos de demostracion

Para cargar catalogos, productos, codigos de barras, lotes, existencias y clientes, ejecuta `demo_data.sql` desde phpMyAdmin. En una base nueva Docker lo carga automaticamente despues de `apimax.sql`.

El script crea dos personas que puedes usar para los usuarios `admin_demo` (Administrador) y `empleado_demo` (Empleado). Crea ambas cuentas desde phpMyAdmin con hashes generados en Codespaces:

```bash
php -r 'echo password_hash("TU_CLAVE_ADMIN", PASSWORD_DEFAULT), PHP_EOL;'
```

Despues usa los hashes correspondientes en:

```sql
SELECT id_persona, nombre, ap_paterno, correo
FROM personas
WHERE correo IN ('mariana.demo@apimax.local', 'carlos.demo@apimax.local');

INSERT INTO usuarios (id_persona, usuario, pass, tipo_usuario, fecha_registro, activo)
VALUES
(ID_MARIANA, 'admin_demo', 'HASH_ADMIN', 'Administrador', CURRENT_DATE, 1),
(ID_CARLOS, 'empleado_demo', 'HASH_EMPLEADO', 'Empleado', CURRENT_DATE, 1);
```
