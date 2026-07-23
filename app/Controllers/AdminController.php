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
                'indices'   => \Index::count(),
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
                    require_once ROOT_PATH . '/app/Helpers/MailHelper.php';

                    $subject = 'Bienvenido a AECAUM — Tus credenciales de acceso';
                    $body = "
                        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>
                            <div style='background: #0a3a78; padding: 30px; text-align: center;'>
                                <img src='" . APP_URL . "/assets/img/logo/logo.png' alt='AECAUM' style='max-width: 150px; margin-bottom: 15px;'>
                                <h1 style='color: #ffffff; margin: 0; font-size: 28px; font-weight: 600;'>¡Bienvenido a AECAUM!</h1>
                            </div>
                            <div style='padding: 30px;'>
                                <p style='color: #6d8089; font-size: 16px; line-height: 1.6;'>Hola <strong style='color: #0a3a78;'>{$name}</strong>,</p>
                                <p style='color: #6d8089; font-size: 16px; line-height: 1.6;'>Tu cuenta ha sido creada exitosamente. A continuación encontrarás tus credenciales de acceso:</p>
                                <table style='width:100%; border-collapse: collapse; margin: 25px 0;'>
                                    <tr>
                                        <td style='padding: 15px; background: #F5F6F7; font-weight: bold; color: #0a3a78; border: 1px solid #e5e7eb; width: 40%;'>Nombre</td>
                                        <td style='padding: 15px; border: 1px solid #e5e7eb; color: #6d8089;'>{$name}</td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 15px; background: #F5F6F7; font-weight: bold; color: #0a3a78; border: 1px solid #e5e7eb;'>Correo electrónico</td>
                                        <td style='padding: 15px; border: 1px solid #e5e7eb; color: #6d8089;'>{$email}</td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 15px; background: #F5F6F7; font-weight: bold; color: #0a3a78; border: 1px solid #e5e7eb;'>Contraseña</td>
                                        <td style='padding: 15px; border: 1px solid #e5e7eb; color: #6d8089; font-weight: 600;'>{$password}</td>
                                    </tr>
                                </table>
                                <div style='background: #fff3cd; border-left: 4px solid #ECB014; padding: 15px; margin: 25px 0;'>
                                    <p style='color: #856404; margin: 0; font-size: 14px;'><strong>⚠ Por seguridad, te recomendamos cambiar tu contraseña al iniciar sesión por primera vez.</strong></p>
                                </div>
                                <p style='color: #6d8089; font-size: 16px; line-height: 1.6; margin-top: 25px;'>Saludos,<br><strong style='color: #0a3a78;'>Equipo AECAUM</strong></p>
                            </div>
                            <div style='background: #0a3a78; padding: 20px; text-align: center;'>
                                <p style='color: #ffffff; margin: 0; font-size: 12px; opacity: 0.8;'>© 2026 AECAUM. Todos los derechos reservados.</p>
                            </div>
                        </div>
                    ";

                    $sent = \App\Helpers\MailHelper::sendMail($email, $subject, $body);
                    if (!$sent) {
                        error_log('AdminController — No se pudo enviar correo de bienvenida a: ' . $email . ' | Error: ' . \App\Helpers\MailHelper::$lastError);
                    }
                }

                $this->redirect('admin/usuarios?' . ($ok ? 'success=user_created' : 'error=create_failed'));
                return;
            }

            if ($action === 'update_user') {
                $id       = (int) ($_POST['user_id'] ?? 0);
                $name     = $this->input('name');
                $email    = $this->input('email');
                $password = $_POST['password'] ?? '';
                $roleId   = (int) ($_POST['role_id'] ?? 1);

                $currentUser = User::findById($id);
                if ($currentUser) {
                    $updateData = [
                        'name'    => $name,
                        'email'   => $email,
                        'role_id' => $roleId,
                    ];
                    if (!empty($password)) {
                        $updateData['password'] = $password;
                    }
                    $ok = User::update($id, $updateData);
                    $this->redirect('admin/usuarios?' . ($ok ? 'success=user_updated' : 'error=update_failed'));
                } else {
                    $this->redirect('admin/usuarios?error=user_not_found');
                }
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

    /** Gestión de índices */
    public function indices(): void {
        requireLogin();
        if (!hasRole('Superadmin') && !hasRole('admin')) {
            $this->redirect('dashboard');
            return;
        }

        if ($this->isPost()) {
            $action = $_POST['action'] ?? '';

            if ($action === 'create_index') {
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = ROOT_PATH . '/uploads/indices/';
                    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

                    $filename = time() . '_' . basename($_FILES['image']['name']);
                    $filepath = $uploadDir . $filename;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $filepath)) {
                        $ok = \Index::create([
                            'title'       => $this->input('title'),
                            'image'       => 'uploads/indices/' . $filename,
                            'description' => $this->input('description'),
                            'month'       => $this->input('month') ?: 'enero',
                            'year'        => (int)($this->input('year') ?: date('Y')),
                        ]);

                        $this->redirect('admin/indices?' . ($ok ? 'success=index_created' : 'error=create_failed'));
                        return;
                    }
                }
                $this->redirect('admin/indices?error=upload_failed');
                return;
            }

            if ($action === 'delete_index') {
                $id = (int) ($_POST['index_id'] ?? 0);
                if ($id) {
                    $index = \Index::findById($id);
                    if ($index && file_exists(ROOT_PATH . '/' . $index['image'])) {
                        unlink(ROOT_PATH . '/' . $index['image']);
                    }
                    \Index::delete($id);
                    $this->redirect('admin/indices?success=index_deleted');
                } else {
                    $this->redirect('admin/indices?error=delete_failed');
                }
                return;
            }
        }

        $this->render('admin/indices', [
            'pageTitle'   => 'Índices | Admin AECAUM',
            'currentUser' => getCurrentUser(),
            'indices'     => \Index::all(),
            'success'     => $this->query('success'),
            'error'       => $this->query('error'),
        ], 'panel');
    }

    /** Gestión de mensajes de contacto */
    public function contactMessages(): void {
        requireLogin();
        if (!hasRole('Superadmin') && !hasRole('admin')) {
            $this->redirect('dashboard');
            return;
        }

        if ($this->isPost()) {
            $action = $_POST['action'] ?? '';

            if ($action === 'delete_message') {
                $id = (int) ($_POST['message_id'] ?? 0);
                if ($id) {
                    Contact::delete($id);
                    $this->redirect('admin/contacto?success=message_deleted');
                } else {
                    $this->redirect('admin/contacto?error=delete_failed');
                }
                return;
            }
        }

        $this->render('admin/contact', [
            'pageTitle'   => 'Mensajes de Contacto | Admin AECAUM',
            'currentUser' => getCurrentUser(),
            'messages'    => Contact::all(),
            'success'     => $this->query('success'),
            'error'       => $this->query('error'),
        ], 'panel');
    }
}
