<?php
// ============================================================
// Model: Role
// ============================================================

class Role {

    /** Retorna todos los roles */
    public static function all(): array {
        global $conn;
        $result = $conn->query("SELECT * FROM roles ORDER BY id ASC");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /** Busca un rol por ID */
    public static function findById(int $id): ?array {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM roles WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    /** Busca un rol por nombre */
    public static function findByName(string $name): ?array {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM roles WHERE name = ?");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    /** Crea un nuevo rol */
    public static function create(array $data): bool {
        global $conn;
        $stmt = $conn->prepare("
            INSERT INTO roles (name, label, description) VALUES (?, ?, ?)
        ");
        $stmt->bind_param('sss', $data['name'], $data['label'], $data['description']);
        return $stmt->execute();
    }

    /** Elimina un rol por ID */
    public static function delete(int $id): bool {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM roles WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    /** Cuenta el total de roles */
    public static function count(): int {
        global $conn;
        $result = $conn->query("SELECT COUNT(*) AS total FROM roles");
        return $result ? (int) $result->fetch_assoc()['total'] : 0;
    }
}
