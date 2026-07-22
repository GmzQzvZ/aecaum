<?php
// ============================================================
// ACAEUM — Base de Datos y Autenticación
// ============================================================

// Cargar variables de entorno desde .env
function loadEnv($file) {
    if (!file_exists($file)) {
        return;
    }
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}
loadEnv(__DIR__ . '/../.env');

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'aecaum_db');

// Configuración de JWT
define('JWT_SECRET', getenv('JWT_SECRET') ?: 'default_secret_change_in_production');

// Configuración de SMTP (PHPMailer)
define('SMTP_HOST', getenv('SMTP_HOST') ?: 'smtp.gmail.com');
define('SMTP_USER', getenv('SMTP_USER') ?: '');
define('SMTP_PASS', getenv('SMTP_PASS') ?: '');
define('SMTP_PORT', getenv('SMTP_PORT') ?: 465);
define('SMTP_SECURE', getenv('SMTP_SECURE') ?: 'ssl');
define('MAIL_FROM', getenv('MAIL_FROM') ?: SMTP_USER);
define('MAIL_FROM_NAME', getenv('MAIL_FROM_NAME') ?: 'Soporte ACAEUM');


// Conexión global
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    // No exponer detalles en producción
    http_response_code(503);
    die('<p style="font-family:sans-serif;padding:40px;">
        <strong>Error de conexión a la base de datos.</strong><br>
        Verificá que MySQL esté corriendo y que la base de datos <code>' . DB_NAME . '</code> exista.
    </p>');
}

$conn->set_charset('utf8mb4');

// ============================================================
// Funciones de Autenticación
// ============================================================

function isLoggedIn(): bool {
    return isset($_COOKIE['aecaum_token']) && \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']) !== null;
}

function hasRole(string $role): bool {
    if (!isset($_COOKIE['aecaum_token'])) return false;
    $payload = \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']);
    return $payload && isset($payload['role_name']) && $payload['role_name'] === $role;
}

function hasAccess(array $allowedRoles): bool {
    if (!isset($_COOKIE['aecaum_token'])) return false;
    $payload = \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']);
    return $payload && isset($payload['role_name']) && (in_array($payload['role_name'], $allowedRoles) || $payload['role_name'] === 'Superadmin' || $payload['role_name'] === 'admin');
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: ' . APP_URL . '/login');
        exit;
    }
}

function requireRole(string $role): void {
    requireLogin();
    if (!hasRole($role)) {
        header('Location: ' . APP_URL . '/dashboard');
        exit;
    }
}

function getCurrentUser(): ?array {
    if (!isset($_COOKIE['aecaum_token'])) return null;
    $payload = \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']);
    if (!$payload) return null;
    
    global $conn;
    $stmt = $conn->prepare("
        SELECT u.*, r.name AS role_name, r.label AS role_label
        FROM users u
        JOIN roles r ON u.role_id = r.id
        WHERE u.id = ?
    ");
    $stmt->bind_param('i', $payload['user_id']);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
