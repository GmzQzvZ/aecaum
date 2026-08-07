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

        $this->render('dashboard/index', [
            'pageTitle'   => 'Mi Panel | AECAUM',
            'currentUser' => $currentUser,
            'documents'   => $documents,
            'stats'       => [
                'documents' => count($documents)
            ],
        ], 'panel');
    }

    public function indices(): void {
        requireLogin();

        // Redirigir admins a su panel
        if (hasRole('Superadmin') || hasRole('admin')) {
            $this->redirect('admin/indices');
            return;
        }

        $indices = \Index::all();

        $this->render('dashboard/indices', [
            'pageTitle'   => 'Índices | AECAUM',
            'currentUser' => getCurrentUser(),
            'indices'     => $indices,
        ], 'panel');
    }
    public function informesInstitucionales(): void {
        requireLogin();

        // Redirigir admins a su panel
        if (hasRole('Superadmin') || hasRole('admin')) {
            $this->redirect('admin/informes');
            return;
        }

        $informes = \Informe::all();

        $this->render('dashboard/informes-institucionales', [
            'pageTitle'   => 'Informes Institucionales | AECAUM',
            'currentUser' => getCurrentUser(),
            'informes'     => $informes,
        ], 'panel');
    }
}
