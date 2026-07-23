<?php
// ============================================================
// Model: Contact
// ============================================================

class Contact {

    /** Retorna todos los mensajes de contacto */
    public static function all(): array {
        global $conn;
        $result = $conn->query("
            SELECT * FROM contact_messages 
            ORDER BY created_at DESC
        ");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /** Crea un nuevo mensaje de contacto */
    public static function create(array $data): bool {
        global $conn;
        $stmt = $conn->prepare("
            INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)
        ");
        $stmt->bind_param('sss', $data['name'], $data['email'], $data['message']);
        return $stmt->execute();
    }

    /** Elimina un mensaje por ID */
    public static function delete(int $id): bool {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM contact_messages WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    /** Cuenta el total de mensajes */
    public static function count(): int {
        global $conn;
        $result = $conn->query("SELECT COUNT(*) AS total FROM contact_messages");
        return $result ? (int) $result->fetch_assoc()['total'] : 0;
    }
}
