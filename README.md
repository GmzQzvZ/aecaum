# AECAUM

Aplicación web PHP MVC para el portal ACAEUM con autenticación, administración de usuarios, roles, documentos e índices públicos.

## Características principales

- Inicio de sesión con JWT y cookies seguras
- Panel de administración para usuarios, roles, documentos, índices y mensajes de contacto
- Recuperación y restablecimiento de contraseña vía correo electrónico
- Rutas públicas de contenido e índice
- Integración con PHPMailer para envío de emails
- Autoload PSR-4 con Composer

## Requisitos

- PHP 7.4 o superior
- MySQL / MariaDB
- Apache o un servidor compatible con PHP
- Composer
- Extensiones PHP recomendadas: `mysqli`, `openssl`, `json`, `mbstring`

## Instalación

1. Clona o copia el proyecto en el directorio de tu servidor web. Por ejemplo, `c:\xampp\htdocs\aecaum`.
2. Instala dependencias de Composer:

```bash
composer install
```

3. Crea un archivo `.env` en la raíz del proyecto con las variables de configuración necesarias.

### Ejemplo de `.env`

```dotenv
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=aecaum_db

JWT_SECRET=tu_secreto_jwt_seguro

SMTP_HOST=smtp.gmail.com
SMTP_USER=tu_email@example.com
SMTP_PASS=tu_password_o_app_password
SMTP_PORT=465
SMTP_SECURE=ssl
MAIL_FROM=tu_email@example.com
MAIL_FROM_NAME="Soporte ACAEUM"
```

4. Importa la base de datos desde `database.sql` en tu servidor MySQL.

5. Asegúrate de que el proyecto tenga acceso de lectura/escritura a `uploads/` si se usan cargas de archivos.

## Configuración

El proyecto detecta automáticamente la URL base desde `$_SERVER['SCRIPT_NAME']` mediante `config/app.php`.

Las constantes principales se definen en:

- `bootstrap.php`
- `config/app.php`
- `config/database.php`

### Variables importantes

- `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`
- `JWT_SECRET`
- `SMTP_HOST`, `SMTP_USER`, `SMTP_PASS`, `SMTP_PORT`, `SMTP_SECURE`
- `MAIL_FROM`, `MAIL_FROM_NAME`

## Estructura del proyecto

- `index.php` — Front controller único
- `bootstrap.php` — Carga inicial, sesión, autoload y configuración global
- `app/Router.php` — Enrutador de la aplicación
- `app/Controllers/` — Controladores MVC
- `app/Models/` — Modelos de datos
- `app/Views/` — Plantillas de vistas
- `assets/` — Archivos CSS, JS e imágenes
- `uploads/` — Archivos subidos
- `config/` — Configuración y base de datos
- `vendor/` — Dependencias de Composer

## Uso

- Accede al proyecto desde tu navegador usando la URL local correspondiente, por ejemplo:

```
http://localhost/aecaum
```

- Inicia sesión desde la ruta `/login`.
- El panel de administración se encuentra en `/admin`.
- La sección de usuario se encuentra en `/dashboard`.

## Rutas importantes

- `/` o `/home` — Página principal
- `/login` — Login
- `/logout` — Cerrar sesión
- `/recuperar-clave`, `/forgot-password` — Formulario de recuperación de contraseña
- `/reset-password`, `/reset-clave` — Restablecer contraseña
- `/dashboard` — Panel de usuario
- `/admin` — Dashboard de administración
- `/admin/usuarios`, `/admin/roles`, `/admin/documentos`, `/admin/indices`, `/admin/contacto`
- `/indices`, `/about`, `/contact`, `/faq`, `/blog`, `/network`, entre otras páginas públicas

## Seguridad

- Las contraseñas se almacenan hasheadas con `password_hash`.
- El login usa JWT y cookies `HttpOnly`.
- No se recomienda usar `JWT_SECRET` por defecto en producción.
- Para SMTP con Gmail, usa una contraseña de aplicación si requiere autenticación en dos pasos.

## Notas adicionales

- En entornos de producción, habilita HTTPS y ajusta las opciones de cookie segura.
- Si el panel de administración no funciona, revisa los permisos de la base de datos y los roles en la tabla `roles`.
- El proyecto puede adaptarse para usar un `.env.example` si deseas versionar la plantilla de variables.

## Licencia

Este proyecto no incluye una licencia específica.
