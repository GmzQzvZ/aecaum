<?php
// ============================================================
// ACAEUM — Bootstrap de la aplicación
// ============================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('ROOT_PATH', __DIR__);

// Autoloader de Composer (para JWT, PHPMailer, etc.)
if (file_exists(ROOT_PATH . '/vendor/autoload.php')) {
    require_once ROOT_PATH . '/vendor/autoload.php';
}

require_once ROOT_PATH . '/config/app.php';
require_once ROOT_PATH . '/config/database.php';

// Alias para compatibilidad con vistas legacy
if (!defined('BASE_URL')) {
    define('BASE_URL', BASE_PATH);
}

// Autoload simple de Models y Controllers
spl_autoload_register(function (string $class): void {
    foreach (['Models', 'Controllers'] as $dir) {
        $file = APP_PATH . '/' . $dir . '/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

require_once APP_PATH . '/Router.php';
