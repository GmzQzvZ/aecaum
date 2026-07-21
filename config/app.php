<?php
// ============================================================
// ACAEUM — Configuración de la Aplicación
// ============================================================

// --- Rutas del sistema de archivos ---
define('APP_PATH',      ROOT_PATH . '/app');
define('VIEWS_PATH',    APP_PATH  . '/Views');
define('LAYOUTS_PATH',  VIEWS_PATH . '/layouts');
define('PARTIALS_PATH', VIEWS_PATH . '/partials');
define('UPLOADS_PATH',  ROOT_PATH . '/uploads');

// --- Nombre de la aplicación ---
define('APP_NAME', 'AECAUM');

// --- URL base (auto-detectada, funciona en cualquier servidor/subdirectorio) ---
$protocol  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$scriptDir = rtrim(str_replace(['/index.php', '\\'], ['', '/'], $_SERVER['SCRIPT_NAME']), '/');

define('BASE_PATH',   $scriptDir);
define('APP_URL',     $protocol . '://' . $_SERVER['HTTP_HOST'] . $scriptDir);
define('ASSETS_URL',  APP_URL . '/assets');
define('UPLOADS_URL', APP_URL . '/uploads');
