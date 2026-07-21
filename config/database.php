<?php
// ============================================================
// ACAEUM — Base de Datos y Autenticación
// ============================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'aecaum_db');

// Configuración de JWT
define('JWT_SECRET', 'TZhXHN3Ox+rAo8o/Hi09NKoJ6Fb31EGfdcPM5tL2QBSU=');

// Configuración de SMTP (PHPMailer)
define('SMTP_HOST', 'smtp.gmail.com'); // Ej: smtp.gmail.com
define('SMTP_USER', 'zvzgmzq@gmail.com');
define('SMTP_PASS', 'qefx alae soqn pxuy');
define('SMTP_PORT', 465); // 587 para TLS, 465 para SSL
define('SMTP_SECURE', 'ssl'); // 'tls' o 'ssl'
define('MAIL_FROM', 'no-reply@aecam.com');
define('MAIL_FROM_NAME', 'Soporte ACAEUM');


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
