# Sistema de inventario APIMAX

Aplicación web PHP/MySQL para administrar productos de miel, lotes, entradas, ventas, clientes y salidas por desperdicio.

## Requisitos

- PHP 8.1 o superior con extensiones `pdo_mysql`, `mbstring` y `json`.
- MySQL 8/MariaDB.
- Apache/Nginx configurado para servir esta carpeta.
- El esquema de la base de datos `apimax` (el repositorio original no incluía un archivo `.sql`).

## Configuración

1. Copia `.env.example` a la configuración de variables de entorno de PHP/Apache y define credenciales reales de MySQL. No pongas contraseñas en el código.
2. Configura `APIMAX_TIMEZONE` según la ubicación del negocio.
3. Importa el esquema de la base de datos y verifica que las tablas de inventario tengan `cantidad`, `cantidad_vendida` y `cantidad_desperdiciada` con valor predeterminado `0`.
4. Importa `database/apimax.sql` en MySQL. El script crea las tablas, pero no publica credenciales; sigue `database/README.md` para crear el primer usuario.
5. Abre `/index.php` desde el servidor web.

## Ejecutar en GitHub Codespaces

El repositorio incluye `docker-compose.yml` y `.devcontainer/`. Al crear o reconstruir el Codespace, selecciona **Rebuild Container** si te solicita elegir una configuración. Se iniciarán automáticamente:

- APIMAX en el puerto reenviado `8000`.
- phpMyAdmin en el puerto reenviado `8080`.
- MariaDB con el esquema `database/apimax.sql`.

En el panel **Ports** de Codespaces, abre el puerto `8000`. phpMyAdmin usa el usuario `root` sin contraseña. Esta configuración es únicamente para el contenedor privado de desarrollo; no la uses para publicar el sistema en Internet.

La base de datos se inicializa solo la primera vez que se crea el volumen. Para reiniciarla desde la terminal usa `docker compose down -v` y luego `docker compose up --build`.

El archivo `database/demo_data.sql` agrega información de demostración: tipos de miel, tamaños, productos con códigos de barras, apiarios, ubicaciones, lotes, existencias, dos personas con usuarios (`admin_demo` y `empleado_demo`) y dos clientes. Cambia las contraseñas de demostración antes de usar el sistema fuera de Codespaces.

## Cambios de seguridad y consistencia

- Conexión PDO con consultas preparadas reales, `utf8mb4` y errores internos fuera de la respuesta pública.
- Inicio/cierre de sesión endurecido y regeneración del identificador de sesión.
- Contraseñas nuevas con `password_hash`; los usuarios antiguos en texto plano se migran al iniciar sesión y dejan de mostrarse en la tabla.
- Validación de entradas numéricas y transacciones para ventas, eliminaciones y entradas.
- Las ventas ya no pueden superar el inventario disponible; al editar o eliminar una venta se devuelve correctamente la existencia.

## Pendientes recomendados

El código histórico aún contiene formularios secundarios con consultas interpoladas. Conviene migrarlos al mismo patrón parametrizado antes de publicar el sistema en Internet y añadir el esquema SQL, pruebas de integración y control de permisos por rol.

## Base de datos reconstruida

`database/apimax.sql` fue reconstruido a partir de las tablas y columnas utilizadas por el código PHP. No contiene los datos históricos originales; sirve para levantar un entorno nuevo de pruebas. El campo `entradas.cantidad_disponible` se calcula automáticamente a partir de cantidad, ventas y desperdicios.
