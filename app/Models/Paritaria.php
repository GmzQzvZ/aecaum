<?php
class Paritaria {
    public static function all(): array {
        global $conn;
        $result = $conn->query('SELECT * FROM paritarias ORDER BY year DESC, category ASC, title ASC');
        if (!$result) {
            error_log('Paritaria list failed: ' . $conn->error);
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function create(array $data): bool {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO paritarias (title, document_path, year, category, homologacion_path) VALUES (?, ?, ?, ?, ?)');
        if (!$stmt) {
            error_log('Paritaria prepare failed: ' . $conn->error);
            return false;
        }
        $title = $data['title'];
        $documentPath = $data['document_path'];
        $year = $data['year'];
        $category = $data['category'];
        $homologacionPath = $data['homologacion_path'] ?? null;
        $stmt->bind_param('ssiss', $title, $documentPath, $year, $category, $homologacionPath);
        $saved = $stmt->execute();
        if (!$saved) error_log('Paritaria insert failed: ' . $stmt->error);
        $stmt->close();
        return $saved;
    }

    public static function find(int $id): ?array {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM paritarias WHERE id = ? LIMIT 1');
        if (!$stmt) {
            error_log('Paritaria find prepare failed: ' . $conn->error);
            return null;
        }
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            error_log('Paritaria find failed: ' . $stmt->error);
            $stmt->close();
            return null;
        }
        $result = $stmt->get_result();
        $document = $result ? $result->fetch_assoc() : null;
        $stmt->close();
        return $document ?: null;
    }

    public static function delete(int $id): bool {
        global $conn;
        $stmt = $conn->prepare('DELETE FROM paritarias WHERE id = ?');
        if (!$stmt) {
            error_log('Paritaria delete prepare failed: ' . $conn->error);
            return false;
        }
        $stmt->bind_param('i', $id);
        $deleted = $stmt->execute();
        if (!$deleted) error_log('Paritaria delete failed: ' . $stmt->error);
        $stmt->close();
        return $deleted;
    }
}
