<?php
// ============================================================
// Model: Index — Gestión de índices
// ============================================================

class Index {

    public static function all(): array {
        global $conn;
        $result = $conn->query("SELECT * FROM indices ORDER BY created_at DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function findById(int $id): ?array {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM indices WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function create(array $data): bool {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO indices (title, image, description) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $data['title'], $data['image'], $data['description']);
        return $stmt->execute();
    }

    public static function update(int $id, array $data): bool {
        global $conn;
        $stmt = $conn->prepare("UPDATE indices SET title = ?, image = ?, description = ? WHERE id = ?");
        $stmt->bind_param('sssi', $data['title'], $data['image'], $data['description'], $id);
        return $stmt->execute();
    }

    public static function delete(int $id): bool {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM indices WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public static function count(): int {
        global $conn;
        $result = $conn->query("SELECT COUNT(*) as count FROM indices");
        return $result->fetch_assoc()['count'] ?? 0;
    }
}
