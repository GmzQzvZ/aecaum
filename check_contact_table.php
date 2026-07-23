<?php
require_once __DIR__ . '/bootstrap.php';

global $conn;

// Verificar si la tabla existe
$result = $conn->query("SHOW TABLES LIKE 'contact_messages'");
if ($result && $result->num_rows > 0) {
    echo "✓ La tabla 'contact_messages' existe en la base de datos.\n";
    
    // Contar mensajes existentes
    $countResult = $conn->query("SELECT COUNT(*) AS total FROM contact_messages");
    if ($countResult) {
        $count = $countResult->fetch_assoc()['total'];
        echo "✓ Total de mensajes en la tabla: $count\n";
    }
} else {
    echo "✗ La tabla 'contact_messages' NO existe en la base de datos.\n";
    echo "Debes ejecutar el archivo database.sql para crearla:\n";
    echo "mysql -u tu_usuario -p aecaum_db < database.sql\n";
}

// Verificar conexión
if ($conn->ping()) {
    echo "✓ Conexión a la base de datos activa.\n";
} else {
    echo "✗ Error de conexión a la base de datos.\n";
}
