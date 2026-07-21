<?php
// Configuración de la base de datos
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

// Crear conexión
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer charset
$conn->set_charset("utf8mb4");

// Función para verificar si el usuario está logueado
function isLoggedIn()
{
    return isset($_COOKIE['aecaum_token']) && \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']) !== null;
}

// Función para verificar el rol del usuario
function hasRole($role)
{
    if (!isset($_COOKIE['aecaum_token'])) return false;
    $payload = \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']);
    return $payload && isset($payload['role_name']) && $payload['role_name'] === $role;
}

// Función para verificar si el usuario tiene acceso basado en roles permitidos
function hasAccess($allowedRoles)
{
    if (!isset($_COOKIE['aecaum_token'])) return false;
    $payload = \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']);
    return $payload && isset($payload['role_name']) && (in_array($payload['role_name'], $allowedRoles) || $payload['role_name'] === 'Superadmin' || $payload['role_name'] === 'admin');
}

// Función para redirigir si no está logueado
function requireLogin()
{
    if (!isLoggedIn()) {
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}

// Función para redirigir si no tiene el rol requerido
function requireRole($role)
{
    requireLogin();
    if (!hasRole($role)) {
        header('Location: ' . BASE_URL . '/dashboard');
        exit;
    }
}

// Función para obtener información del usuario actual
function getCurrentUser()
{
    if (!isset($_COOKIE['aecaum_token'])) return null;
    $payload = \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']);
    if (!$payload) return null;
    
    global $conn;
    $stmt = $conn->prepare("SELECT u.*, r.name as role_name, r.label as role_label FROM users u JOIN roles r ON u.role_id = r.id WHERE u.id = ?");
    $stmt->bind_param("i", $payload['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>