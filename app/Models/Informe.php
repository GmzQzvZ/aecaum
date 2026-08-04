<?php
class Informe {
    /**
     * Obtiene todos los informes
     * @return array
     */
    public static function all(): array {
        global $conn;
                $result = $conn->query("SELECT * FROM informes WHERE year >= 2000 ORDER BY year DESC");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Crea un nuevo informe
     * @param array $data 
     * @return bool
     */
    public static function create(array $data): bool {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO informes (title, image, year, file_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssis', $data['title'], $data['image'], $data['year'], $data['file_path']);
        return $stmt->execute();
    }

    /**
     * Elimina un informe por id
     * @param int $id
     * @return bool
     */
    public static function delete(int $id): bool {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM informes WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>
