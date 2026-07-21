<?php
// ============================================================
// Model: Document
// ============================================================

class Document {

    /** Retorna todos los documentos con info del uploader */
    public static function all(): array {
        global $conn;
        $result = $conn->query("
            SELECT d.*, u.name AS uploader_name
            FROM documents d
            LEFT JOIN users u ON d.uploaded_by = u.id
            ORDER BY d.created_at DESC
        ");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /** Retorna documentos accesibles para un usuario/rol específico */
    public static function forUser(int $userId, int $roleId): array {
        global $conn;
        $stmt = $conn->prepare("
            SELECT d.*, u.name AS uploader_name
            FROM documents d
            LEFT JOIN users u ON d.uploaded_by = u.id
            WHERE d.uploaded_by = ?
               OR EXISTS (
                   SELECT 1 FROM document_permissions dp
                   WHERE dp.document_id = d.id AND dp.role_id = ?
               )
            ORDER BY d.created_at DESC
        ");
        $stmt->bind_param('ii', $userId, $roleId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /** Busca un documento por ID */
    public static function findById(int $id): ?array {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM documents WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    /**
     * Crea un documento y asigna permisos de roles.
     *
     * @param array $data           title, filename, path, description, uploaded_by
     * @param int[] $allowedRoleIds IDs de roles con acceso
     */
    public static function create(array $data, array $allowedRoleIds): bool {
        global $conn;

        $stmt = $conn->prepare("
            INSERT INTO documents (title, filename, path, description, uploaded_by)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            'ssssi',
            $data['title'],
            $data['filename'],
            $data['path'],
            $data['description'],
            $data['uploaded_by']
        );

        if (!$stmt->execute()) return false;

        $docId = $conn->insert_id;

        // Insertar permisos por rol
        foreach ($allowedRoleIds as $roleId) {
            $pStmt = $conn->prepare("
                INSERT IGNORE INTO document_permissions (document_id, role_id) VALUES (?, ?)
            ");
            $pStmt->bind_param('ii', $docId, (int) $roleId);
            $pStmt->execute();
        }

        return true;
    }

    /** Elimina un documento (las permissions se eliminan en cascada por FK) */
    public static function delete(int $id): bool {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM documents WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    /** Cuenta el total de documentos */
    public static function count(): int {
        global $conn;
        $result = $conn->query("SELECT COUNT(*) AS total FROM documents");
        return $result ? (int) $result->fetch_assoc()['total'] : 0;
    }

    /** Cuenta documentos accesibles para un usuario/rol */
    public static function countForUser(int $userId, int $roleId): int {
        global $conn;
        $stmt = $conn->prepare("
            SELECT COUNT(*) AS total FROM documents d
            WHERE d.uploaded_by = ?
               OR EXISTS (
                   SELECT 1 FROM document_permissions dp
                   WHERE dp.document_id = d.id AND dp.role_id = ?
               )
        ");
        $stmt->bind_param('ii', $userId, $roleId);
        $stmt->execute();
        return (int) $stmt->get_result()->fetch_assoc()['total'];
    }
}
