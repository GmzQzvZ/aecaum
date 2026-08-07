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
        $stmt = $conn->prepare("INSERT INTO indices (title, image, image2, image3, month, year, informe, informe_mensual) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $month   = $data['month'] ?? 'enero';
        $year    = (int)($data['year'] ?? date('Y'));
        $informe = $data['informe'] ?? '';
        $informe_mensual = $data['informe_mensual'] ?? '';
        $image2  = $data['image2'] ?? null;
        $image3  = $data['image3'] ?? null;
        $stmt->bind_param('sssssiss', $data['title'], $data['image'], $image2, $image3, $month, $year, $informe, $informe_mensual);
        return $stmt->execute();
    }

    public static function update(int $id, array $data): bool {
        global $conn;
        $stmt = $conn->prepare("UPDATE indices SET title = ?, image = ?, image2 = ?, image3 = ?, month = ?, year = ?, informe = ?, informe_mensual = ? WHERE id = ?");
        $month   = $data['month'] ?? 'enero';
        $year    = (int)($data['year'] ?? date('Y'));
        $informe = $data['informe'] ?? '';
        $informe_mensual = $data['informe_mensual'] ?? '';
        $image2  = $data['image2'] ?? null;
        $image3  = $data['image3'] ?? null;
        $stmt->bind_param('sssssissi', $data['title'], $data['image'], $image2, $image3, $month, $year, $informe, $informe_mensual, $id);
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
