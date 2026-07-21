<?php
// ============================================================
// Model: User
// ============================================================

class User {

    /** Busca un usuario por email (con datos de rol) */
    public static function findByEmail(string $email): ?array {
        global $conn;
        $stmt = $conn->prepare("
            SELECT u.*, r.name AS role_name, r.label AS role_label
            FROM users u
            JOIN roles r ON u.role_id = r.id
            WHERE u.email = ?
        ");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    /** Busca un usuario por ID (con datos de rol) */
    public static function findById(int $id): ?array {
        global $conn;
        $stmt = $conn->prepare("
            SELECT u.*, r.name AS role_name, r.label AS role_label
            FROM users u
            JOIN roles r ON u.role_id = r.id
            WHERE u.id = ?
        ");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    /** Retorna todos los usuarios con su rol */
    public static function all(): array {
        global $conn;
        $result = $conn->query("
            SELECT u.*, r.name AS role_name, r.label AS role_label
            FROM users u
            JOIN roles r ON u.role_id = r.id
            ORDER BY u.created_at DESC
        ");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /** Crea un nuevo usuario con contraseña hasheada */
    public static function create(array $data): bool {
        global $conn;
        $hashed = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt = $conn->prepare("
            INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param('sssi', $data['name'], $data['email'], $hashed, $data['role_id']);
        return $stmt->execute();
    }

    /** Actualiza un usuario. Si password está vacío, no lo modifica */
    public static function update(int $id, array $data): bool {
        global $conn;
        if (!empty($data['password'])) {
            $hashed = password_hash($data['password'], PASSWORD_BCRYPT);
            $stmt = $conn->prepare("
                UPDATE users SET name = ?, email = ?, password = ?, role_id = ? WHERE id = ?
            ");
            $stmt->bind_param('sssii', $data['name'], $data['email'], $hashed, $data['role_id'], $id);
        } else {
            $stmt = $conn->prepare("
                UPDATE users SET name = ?, email = ?, role_id = ? WHERE id = ?
            ");
            $stmt->bind_param('ssii', $data['name'], $data['email'], $data['role_id'], $id);
        }
        return $stmt->execute();
    }

    /** Elimina un usuario por ID */
    public static function delete(int $id): bool {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    /** Cuenta el total de usuarios */
    public static function count(): int {
        global $conn;
        $result = $conn->query("SELECT COUNT(*) AS total FROM users");
        return $result ? (int) $result->fetch_assoc()['total'] : 0;
    }
}
