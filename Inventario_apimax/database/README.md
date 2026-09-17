# Preparar el usuario inicial

El esquema no crea una contraseña predeterminada. Genera un hash desde la terminal de Codespaces:

```bash
php -r "echo password_hash('CambiaEstaClave123!', PASSWORD_DEFAULT), PHP_EOL;"
```

Copia el resultado y ejecútalo en MySQL reemplazando `HASH_GENERADO`:

```sql
USE apimax;

INSERT INTO personas (nombre, ap_paterno, fecha_registro, activo)
VALUES ('Administrador', 'APIMAX', CURRENT_DATE, 1);

SET @persona_id = LAST_INSERT_ID();

INSERT INTO usuarios (id_persona, usuario, pass, tipo_usuario, fecha_registro, activo)
VALUES (@persona_id, 'admin', 'HASH_GENERADO', 'Administrador', CURRENT_DATE, 1);
```

Después inicia sesión con el usuario `admin` y la contraseña que elegiste.
