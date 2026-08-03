<?php
// ============================================================
// Controller: Document — Visor y descarga de documentos
// ============================================================

class DocumentController extends BaseController {

    public function serve(): void {
        requireLogin();

        $id = (int) $this->query('id');
        $action = $this->query('action') === 'download' ? 'download' : 'view';

        if (!$id) {
            $this->redirect('dashboard');
            return;
        }

        $document = Document::findById($id);
        if (!$document) {
            echo "Documento no encontrado.";
            return;
        }

        // Verificar permisos
        $payload = \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']);
        $userId = (int) ($payload['user_id'] ?? 0);
        $roleId = (int) ($payload['role_id'] ?? 0);

        if (!hasRole('Superadmin') && !hasRole('admin')) {
            // Verificar si tiene acceso
            $hasAccess = false;
            $allowedDocs = Document::forUser($userId, $roleId);
            foreach ($allowedDocs as $doc) {
                if ((int)$doc['id'] === $id) {
                    $hasAccess = true;
                    break;
                }
            }
            if (!$hasAccess) {
                echo "No tienes permiso para ver este documento.";
                return;
            }
        }

        $filepath = ROOT_PATH . '/' . $document['path'];

        if (!file_exists($filepath)) {
            echo "El archivo físico no se encuentra en el servidor.";
            return;
        }

        $extension = strtolower(pathinfo($document['filename'], PATHINFO_EXTENSION));
        
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif'
        ];

        $mimeType = $mimeTypes[$extension] ?? 'application/octet-stream';

        header('Content-Type: ' . $mimeType);
        
        if ($action === 'download') {
            header('Content-Disposition: attachment; filename="' . $document['filename'] . '"');
        } else {
            header('Content-Disposition: inline; filename="' . $document['filename'] . '"');
        }

        header('Content-Length: ' . filesize($filepath));
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        readfile($filepath);
        exit;
    }
}
