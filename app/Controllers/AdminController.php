<?php
// ============================================================
// Controller: Admin — Panel de administración (solo Superadmin)
// ============================================================

class AdminController extends BaseController {

    /** Dashboard principal del admin */
    public function index(): void {
        requireLogin();
        if (!hasRole('Superadmin') && !hasRole('admin')) {
            $this->redirect('dashboard');
            return;
        }

        $this->render('admin/index', [
            'pageTitle'   => 'Panel Admin | AECAUM',
            'currentUser' => getCurrentUser(),
            'stats' => [
                'users'     => User::count(),
                'roles'     => Role::count(),
                'documents' => Document::count(),
            ],
        ], 'panel');
    }

    /** CRUD de usuarios */
    public function users(): void {
        requireLogin();
        if (!hasRole('Superadmin') && !hasRole('admin')) {
            $this->redirect('dashboard');
            return;
        }

        if ($this->isPost()) {
            $action = $_POST['action'] ?? '';

            if ($action === 'create_user') {
                $name     = $this->input('name');
                $email    = $this->input('email');
                $password = $_POST['password'] ?? '';
                $roleId   = (int) ($_POST['role_id'] ?? 1);

                $ok = User::create([
                    'name'     => $name,
                    'email'    => $email,
                    'password' => $password,
                    'role_id'  => $roleId,
                ]);

                if ($ok) {
                    // Enviar correo de bienvenida con las credenciales
                    $subject = 'Bienvenido a AECAUM — Tus credenciales de acceso';
                    $body = "
                        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                            <h2 style='color: #2c3e50;'>¡Bienvenido a AECAUM!</h2>
                            <p>Hola <strong>{$name}</strong>,</p>
                            <p>Tu cuenta ha sido creada exitosamente. A continuación encontrarás tus credenciales de acceso:</p>
                            <table style='width:100%; border-collapse: collapse; margin: 20px 0;'>
                                <tr>
                                    <td style='padding: 10px; background: #f4f6f8; font-weight: bold; border: 1px solid #ddd; width: 40%;'>Nombre</td>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>{$name}</td>
                                </tr>
                                <tr>
                                    <td style='padding: 10px; background: #f4f6f8; font-weight: bold; border: 1px solid #ddd;'>Correo electrónico</td>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>{$email}</td>
                                </tr>
                                <tr>
                                    <td style='padding: 10px; background: #f4f6f8; font-weight: bold; border: 1px solid #ddd;'>Contraseña</td>
                                    <td style='padding: 10px; border: 1px solid #ddd;'>{$password}</td>
                                </tr>
                            </table>
                            <p style='color: #e74c3c;'><strong>Por seguridad, te recomendamos cambiar tu contraseña al iniciar sesión por primera vez.</strong></p>
                            <p>Saludos,<br><strong>Equipo AECAUM</strong></p>
                        </div>
                    ";
                    \App\Helpers\MailHelper::sendMail($email, $subject, $body);
                }

                $this->redirect('admin/usuarios?' . ($ok ? 'success=user_created' : 'error=create_failed'));
                return;
            }

            if ($action === 'delete_user') {
                $id = (int) ($_POST['user_id'] ?? 0);
                // Protección: no eliminar al propio usuario
                $payload = \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']);
                if ($id && $payload && $id !== (int) $payload['user_id']) {
                    User::delete($id);
                    $this->redirect('admin/usuarios?success=user_deleted');
                } else {
                    $this->redirect('admin/usuarios?error=delete_failed');
                }
                return;
            }
        }

        $this->render('admin/users', [
            'pageTitle'   => 'Usuarios | Admin AECAUM',
            'currentUser' => getCurrentUser(),
            'users'       => User::all(),
            'roles'       => Role::all(),
            'success'     => $this->query('success'),
            'error'       => $this->query('error'),
        ], 'panel');
    }

    /** CRUD de roles */
    public function roles(): void {
        requireLogin();
        if (!hasRole('Superadmin') && !hasRole('admin')) {
            $this->redirect('dashboard');
            return;
        }

        if ($this->isPost()) {
            $action = $_POST['action'] ?? '';

            if ($action === 'create_role') {
                Role::create([
                    'name'        => $this->input('name'),
                    'label'       => $this->input('label'),
                    'description' => $this->input('description'),
                ]);
                $this->redirect('admin/roles?success=role_created');
                return;
            }

            if ($action === 'delete_role') {
                $id = (int) ($_POST['role_id'] ?? 0);
                if ($id) Role::delete($id);
                $this->redirect('admin/roles?success=role_deleted');
                return;
            }
        }

        $this->render('admin/roles', [
            'pageTitle'   => 'Roles | Admin AECAUM',
            'currentUser' => getCurrentUser(),
            'roles'       => Role::all(),
            'success'     => $this->query('success'),
            'error'       => $this->query('error'),
        ], 'panel');
    }

    /** Gestión de documentos */
    public function documents(): void {
        requireLogin();
        if (!hasRole('Superadmin') && !hasRole('admin')) {
            $this->redirect('dashboard');
            return;
        }

        if ($this->isPost()) {
            $action = $_POST['action'] ?? '';

            if ($action === 'upload_document') {
                if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = ROOT_PATH . '/uploads/';
                    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

                    $filename = time() . '_' . basename($_FILES['document']['name']);
                    $filepath = $uploadDir . $filename;

                    if (move_uploaded_file($_FILES['document']['tmp_name'], $filepath)) {
                        $allowedRoleIds = array_map('intval', $_POST['allowed_roles'] ?? []);
                        $payload = \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']);
                        Document::create([
                            'title'       => $this->input('title'),
                            'filename'    => $filename,
                            'path'        => 'uploads/' . $filename,
                            'description' => $this->input('description'),
                            'uploaded_by' => (int) ($payload['user_id'] ?? 0),
                        ], $allowedRoleIds);

                        $this->redirect('admin/documentos?success=document_uploaded');
                        return;
                    }
                }
                $this->redirect('admin/documentos?error=upload_failed');
                return;
            }

            if ($action === 'delete_document') {
                $id = (int) ($_POST['document_id'] ?? 0);
                if ($id) Document::delete($id);
                $this->redirect('admin/documentos?success=document_deleted');
                return;
            }
        }

        $this->render('admin/documents', [
            'pageTitle'   => 'Documentos | Admin AECAUM',
            'currentUser' => getCurrentUser(),
            'documents'   => Document::all(),
            'roles'       => Role::all(),
            'success'     => $this->query('success'),
            'error'       => $this->query('error'),
        ], 'panel');
    }
}
