<?php
// ============================================================
// Controller: Dashboard — Panel de usuario autenticado
// ============================================================

class DashboardController extends BaseController {

    public function index(): void {
        requireLogin();

        // Redirigir admins a su panel
        if (hasRole('Superadmin') || hasRole('admin')) {
            $this->redirect('admin');
            return;
        }

        $payload = \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']);
        $currentUser = getCurrentUser();
        $userId      = (int) ($payload['user_id'] ?? 0);
        $roleId      = (int) ($payload['role_id'] ?? 0);

        $documents = Document::forUser($userId, $roleId);
        $uploaded  = array_filter($documents, fn($d) => (int)$d['uploaded_by'] === $userId);

        $this->render('dashboard/index', [
            'pageTitle'   => 'Mi Panel | AECAUM',
            'currentUser' => $currentUser,
            'documents'   => $documents,
            'stats'       => [
                'documents' => count($documents),
                'uploaded'  => count($uploaded),
            ],
        ], 'panel');
    }
}
