<?php
// Script de prueba para validar que la migración ha sido exitosa (para desarrollo)
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/Models/User.php';
require_once __DIR__ . '/app/Models/Role.php';
require_once __DIR__ . '/app/Models/Document.php';

header('Content-Type: text/plain; charset=utf-8');
echo "=== PRUEBA DE CONEXIÓN Y MODELOS ===\n\n";

if ($conn->connect_error) {
    die("Error de conexión a la BD: " . $conn->connect_error);
}
echo "Conexión a MySQL: OK\n";

// Probar Modelos
$roles = Role::all();
echo "Roles encontrados: " . count($roles) . "\n";

$users = User::all();
echo "Usuarios encontrados: " . count($users) . "\n";

$documents = Document::all();
echo "Documentos encontrados: " . count($documents) . "\n";

echo "\n¡Migración inicial exitosa!";
