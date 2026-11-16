<?php
// ============================================================
// Controller: Admin — Panel de administración (solo Superadmin)
// ============================================================

class AdminController extends BaseController {

    /** Edición del título y los dos textos de cada mes de la agenda. */
    public function agenda(): void {
        requireLogin();
        if (!hasRole('Superadmin') && !hasRole('admin')) {
            $this->redirect('dashboard');
            return;
        }

        if ($this->isPost() && ($_POST['action'] ?? '') === 'save_agenda_month') {
            // PHP empties both superglobals when the request exceeds post_max_size.
            if (empty($_POST) && empty($_FILES) && (int) ($_SERVER['CONTENT_LENGTH'] ?? 0) > 0) {
                $this->redirect('admin/agenda?month=' . (int) ($_GET['month'] ?? 1) . '&error=upload_too_large');
                return;
            }
            $years = \Agenda::years();
            $year = $years ? max($years) : (int) date('Y');
            $month = (int) ($_POST['month_number'] ?? 0);
            if ($year < 1 || $year > 9999 || !isset(\Agenda::MONTHS[$month])) {
                $this->redirect('admin/agenda?error=invalid_selection');
                return;
            }
            $sections = $_POST['sections'] ?? [];
            $ok = is_array($sections) && \Agenda::saveSections($year, $month, $sections);
            if (!$ok) {
                error_log('Agenda saveSections failed: ' . ($GLOBALS['conn']->error ?? 'unknown database error'));
                $this->redirect('admin/agenda?month=' . $month . '&error=sections_save_failed');
                return;
            }
            $uploadError = '';
            $noteImages = $_FILES['note_images'] ?? null;
            if ($ok && $noteImages && is_array($noteImages['name'] ?? null)) {
                $uploadDir = ROOT_PATH . '/uploads/agenda/';
                if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
                    $ok = false;
                    $uploadError = 'No se pudo crear el directorio uploads/agenda.';
                }
                $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
                foreach ($noteImages['name'] as $index => $_name) {
                    $fileError = (int) ($noteImages['error'][$index] ?? UPLOAD_ERR_NO_FILE);
                    if ($fileError === UPLOAD_ERR_NO_FILE) continue;
                    $tmp = $noteImages['tmp_name'][$index] ?? '';
                    $mime = $fileError === UPLOAD_ERR_OK && is_uploaded_file($tmp) ? (new finfo(FILEINFO_MIME_TYPE))->file($tmp) : '';
                    if ($fileError !== UPLOAD_ERR_OK || !isset($allowed[$mime])) {
                        $uploadError = $this->agendaUploadError($fileError, $mime, (int) ($noteImages['size'][$index] ?? 0));
                        $ok = false;
                        break;
                    }
                    $filename = $year . '_' . $month . '_' . (int) $index . '_' . bin2hex(random_bytes(8)) . '.' . $allowed[$mime];
                    if (!move_uploaded_file($tmp, $uploadDir . $filename)) {
                        $uploadError = 'No se pudo mover la imagen al directorio uploads/agenda. Revisá permisos de escritura.';
                        $ok = false;
                        break;
                    }
                    $persistedIndex = 0;
                    foreach ($sections as $submittedIndex => $section) {
                        if (!is_array($section)) continue;
                        if (trim((string) ($section['title'] ?? '')) === '' && trim(strip_tags((string) ($section['text'] ?? ''))) === '') continue;
                        if ((string) $submittedIndex === (string) $index) break;
                        $persistedIndex++;
                    }
                    if (!\Agenda::saveNoteImage($year, $month, $persistedIndex, 'uploads/agenda/' . $filename)) {
                        $uploadError = 'La imagen se cargó, pero no se pudo guardar con la nota en la base de datos.';
                        $ok = false;
                        break;
                    }
                }
            }
            $errorCode = $uploadError !== '' ? 'error=upload_failed&reason=' . rawurlencode($uploadError) : 'error=save_failed';
            $this->redirect('admin/agenda?month=' . $month . '&' . ($ok ? 'success=agenda_saved' : $errorCode));
            return;
        }

        $years = \Agenda::years();
        $year = $years ? max($years) : (int) date('Y');
        $entries = \Agenda::all($year);
        $month = (int) $this->query('month', (string) (array_key_first($entries) ?: 1));
        if (!isset(\Agenda::MONTHS[$month])) $month = 1;

        $this->render('admin/agenda', [
            'pageTitle'   => 'Agenda Institucional | Admin AECAUM',
            'currentUser' => getCurrentUser(),
            'months'      => \Agenda::MONTHS,
            'entries'     => $entries,
            'selectedMonth' => $month,
            'editModal'   => $this->query('edit') === '1',
            'success'     => $this->query('success'),
            'error'       => $this->query('error'),
        ], 'panel');
    }

    private function agendaUploadError(int $error, string $mime, int $size): string {
        if ($error === UPLOAD_ERR_INI_SIZE || $error === UPLOAD_ERR_FORM_SIZE) return 'PHP rechazó la imagen por superar upload_max_filesize o post_max_size.';
        if ($error === UPLOAD_ERR_PARTIAL) return 'La imagen llegó incompleta; intentá cargarla nuevamente.';
        if ($error === UPLOAD_ERR_NO_TMP_DIR || $error === UPLOAD_ERR_CANT_WRITE) return 'PHP no pudo guardar el archivo temporal; revisá la configuración de cargas y permisos.';
        if ($error !== UPLOAD_ERR_OK) return 'PHP rechazó la imagen (código de carga ' . $error . ').';
        if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp'], true)) return 'El archivo no es JPG, PNG o WebP válido.';
        return 'No se pudo procesar la imagen.';
    }

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
                    $logoUrl = 'https://r2.fivemanage.com/MfeHpBFNP9b0bx7GdZMbE/Logoblanco.png';

                    $subject = 'Bienvenido a AECA Última Milla — Tus credenciales de acceso';
                    $body = "
                        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>
                            <div style='background: #0a3a78; padding: 30px; text-align: center;'>
                                <img src='{$logoUrl}' alt='AECA Última Milla' style='max-width: 300px; margin-bottom: -100px; margin-top: -100px;'>
                                <h1 style='color: #ffffff; margin: 0; font-size: 28px; font-weight: 600;'>¡Bienvenido a AECA Última Milla!</h1>
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
                                <p style='color: #6d8089; font-size: 16px; line-height: 1.6; margin-top: 25px;'>Saludos,<br><strong style='color: #0a3a78;'>Equipo AECA Última Milla</strong></p>
                            </div>
                            <div style='background: #0a3a78; padding: 20px; text-align: center;'>
                                <p style='color: #ffffff; margin: 0; font-size: 12px; opacity: 0.8;'>© 2026 AECA Última Milla. Todos los derechos reservados.</p>
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

                    // Guardamos el archivo físicamente sin extensión usando un hash
                    $physicalHash = bin2hex(random_bytes(16));
                    $filepath = $uploadDir . $physicalHash;
                    $originalFilename = basename($_FILES['document']['name']);

                    if (move_uploaded_file($_FILES['document']['tmp_name'], $filepath)) {
                        $allowedRoleIds = array_map('intval', $_POST['allowed_roles'] ?? []);
                        $payload = \App\Helpers\JwtHelper::verifyToken($_COOKIE['aecaum_token']);
                        Document::create([
                            'title'       => $this->input('title'),
                            'filename'    => $originalFilename,
                            'path'        => 'uploads/' . $physicalHash, // Físicamente se guarda así
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
                $uploadDir = ROOT_PATH . '/uploads/indices/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

                $imagePath = '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $filename = time() . '_1_' . basename($_FILES['image']['name']);
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
                        $imagePath = 'uploads/indices/' . $filename;
                    }
                }

                $image2Path = null;
                if (isset($_FILES['image2']) && $_FILES['image2']['error'] === UPLOAD_ERR_OK) {
                    $filename = time() . '_2_' . basename($_FILES['image2']['name']);
                    if (move_uploaded_file($_FILES['image2']['tmp_name'], $uploadDir . $filename)) {
                        $image2Path = 'uploads/indices/' . $filename;
                    }
                }

                $image3Path = null;
                if (isset($_FILES['image3']) && $_FILES['image3']['error'] === UPLOAD_ERR_OK) {
                    $filename = time() . '_3_' . basename($_FILES['image3']['name']);
                    if (move_uploaded_file($_FILES['image3']['tmp_name'], $uploadDir . $filename)) {
                        $image3Path = 'uploads/indices/' . $filename;
                    }
                }

                $informePath = '';
                if (isset($_FILES['informe']) && $_FILES['informe']['error'] === UPLOAD_ERR_OK) {
                    $filename = time() . '_pdf_' . basename($_FILES['informe']['name']);
                    if (move_uploaded_file($_FILES['informe']['tmp_name'], $uploadDir . $filename)) {
                        $informePath = 'uploads/indices/' . $filename;
                    }
                }

                $informeMensualPath = '';
                if (isset($_FILES['informe_mensual']) && $_FILES['informe_mensual']['error'] === UPLOAD_ERR_OK) {
                    $filename = time() . '_mensual_' . basename($_FILES['informe_mensual']['name']);
                    if (move_uploaded_file($_FILES['informe_mensual']['tmp_name'], $uploadDir . $filename)) {
                        $informeMensualPath = 'uploads/indices/' . $filename;
                    }
                }

                if ($imagePath && $informePath && $informeMensualPath) { // Ambos marcados como required en HTML
                    $ok = \Index::create([
                        'title'   => $this->input('title'),
                        'image'   => $imagePath,
                        'image2'  => $image2Path,
                        'image3'  => $image3Path,
                        'month'   => $this->input('month') ?: 'enero',
                        'year'    => (int)($this->input('year') ?: date('Y')),
                        'informe' => $informePath,
                        'informe_mensual' => $informeMensualPath,
                    ]);
                    $this->redirect('admin/indices?' . ($ok ? 'success=index_created' : 'error=create_failed'));
                    return;
                }
                $this->redirect('admin/indices?error=upload_failed');
                return;
            }

            if ($action === 'update_index') {
                $id = (int) ($_POST['index_id'] ?? 0);
                $index = $id ? \Index::findById($id) : null;
                if (!$index) {
                    $this->redirect('admin/indices?error=index_not_found');
                    return;
                }

                $paths = [
                    'image' => $index['image'],
                    'image2' => $index['image2'],
                    'image3' => $index['image3'],
                    'informe' => $index['informe'],
                    'informe_mensual' => $index['informe_mensual'],
                ];
                $replacedFiles = [];
                $newFiles = [];
                $uploadDir = ROOT_PATH . '/uploads/indices/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                $fileRules = [
                    'image' => ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'],
                    'image2' => ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'],
                    'image3' => ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'],
                    'informe' => ['application/pdf' => 'pdf'],
                    'informe_mensual' => ['application/pdf' => 'pdf'],
                ];
                foreach ($fileRules as $field => $allowed) {
                    if (!isset($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) continue;
                    $file = $_FILES[$field];
                    $mime = $file['error'] === UPLOAD_ERR_OK && is_uploaded_file($file['tmp_name'])
                        ? (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name'])
                        : '';
                    if ($file['error'] !== UPLOAD_ERR_OK || !isset($allowed[$mime]) || $file['size'] > 15 * 1024 * 1024) {
                        foreach ($newFiles as $newFile) if (is_file($newFile)) unlink($newFile);
                        $this->redirect('admin/indices?error=upload_failed');
                        return;
                    }
                    $filename = 'index_' . $id . '_' . $field . '_' . bin2hex(random_bytes(6)) . '.' . $allowed[$mime];
                    if (!move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
                        foreach ($newFiles as $newFile) if (is_file($newFile)) unlink($newFile);
                        $this->redirect('admin/indices?error=upload_failed');
                        return;
                    }
                    $newFiles[] = $uploadDir . $filename;
                    if (!empty($paths[$field])) $replacedFiles[] = ROOT_PATH . '/' . $paths[$field];
                    $paths[$field] = 'uploads/indices/' . $filename;
                }

                $ok = \Index::update($id, [
                    'title' => $this->input('title'),
                    'image' => $paths['image'],
                    'image2' => $paths['image2'],
                    'image3' => $paths['image3'],
                    'month' => $this->input('month') ?: $index['month'],
                    'year' => (int) ($_POST['year'] ?? $index['year']),
                    'informe' => $paths['informe'],
                    'informe_mensual' => $paths['informe_mensual'],
                ]);
                if ($ok) {
                    foreach ($replacedFiles as $oldFile) if (is_file($oldFile)) unlink($oldFile);
                } else {
                    foreach ($newFiles as $newFile) if (is_file($newFile)) unlink($newFile);
                }
                $this->redirect('admin/indices?' . ($ok ? 'success=index_updated' : 'error=update_failed'));
                return;
            }

            if ($action === 'delete_index') {
                $id = (int) ($_POST['index_id'] ?? 0);
                if ($id) {
                    $index = \Index::findById($id);
                    if ($index) {
                        if (!empty($index['image']) && file_exists(ROOT_PATH . '/' . $index['image'])) unlink(ROOT_PATH . '/' . $index['image']);
                        if (!empty($index['image2']) && file_exists(ROOT_PATH . '/' . $index['image2'])) unlink(ROOT_PATH . '/' . $index['image2']);
                        if (!empty($index['image3']) && file_exists(ROOT_PATH . '/' . $index['image3'])) unlink(ROOT_PATH . '/' . $index['image3']);
                        if (!empty($index['informe']) && file_exists(ROOT_PATH . '/' . $index['informe'])) unlink(ROOT_PATH . '/' . $index['informe']);
                        if (!empty($index['informe_mensual']) && file_exists(ROOT_PATH . '/' . $index['informe_mensual'])) unlink(ROOT_PATH . '/' . $index['informe_mensual']);
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

    /** Gestión de informes institucionales */
    public function informes(): void {
        requireLogin();
        if (!hasRole('Superadmin') && !hasRole('admin')) {
            $this->redirect('dashboard');
            return;
        }
        if ($this->isPost()) {
            $action = $_POST['action'] ?? '';
            if ($action === 'create_informe') {
                // Handle image upload
                $imagePath = '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = ROOT_PATH . '/uploads/img/libros/';
                    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                    $filename = time() . '_' . basename($_FILES['image']['name']);
                    $dest = $uploadDir . $filename;
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                        $imagePath = 'uploads/img/libros/' . $filename;
                    }
                }
                // Handle PDF upload
                $filePath = '';
                if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                    $uploadDirFile = ROOT_PATH . '/uploads/docs/informes/';
                    if (!is_dir($uploadDirFile)) mkdir($uploadDirFile, 0755, true);
                    $filenameFile = time() . '_' . basename($_FILES['file']['name']);
                    $destFile = $uploadDirFile . $filenameFile;
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $destFile)) {
                        $filePath = 'uploads/docs/informes/' . $filenameFile;
                    }
                }
                $ok = Informe::create([
                    'title' => $this->input('title'),
                    'image' => $imagePath,
                    'year' => (int)$this->input('year'),
                    'file_path' => $filePath,
                    'route' => $this->input('route'),
                ]);
                $this->redirect('admin/informes?' . ($ok ? 'success=informe_created' : 'error=create_failed'));
                return;
            }
            if ($action === 'delete_informe') {
                $id = (int)($_POST['informe_id'] ?? 0);
                if ($id) {
                    // Fetch record to delete image file
                    $all = Informe::all();
                    foreach ($all as $inf) {
                        if ($inf['id'] == $id) {
                            // Delete image file if exists
                            $img = $inf['image'];
                            if ($img && file_exists(ROOT_PATH . '/' . $img)) {
                                unlink(ROOT_PATH . '/' . $img);
                            }
                            // Delete uploaded PDF file if exists
                            $file = $inf['file_path'] ?? '';
                            if ($file && file_exists(ROOT_PATH . '/' . $file)) {
                                unlink(ROOT_PATH . '/' . $file);
                            }
                        }
                    }
                    Informe::delete($id);
                    $this->redirect('admin/informes?success=informe_deleted');
                } else {
                    $this->redirect('admin/informes?error=delete_failed');
                }
                return;
            }
        }
        $this->render('admin/informes', [
            'pageTitle'   => 'Informes | Admin AECAUM',
            'currentUser' => getCurrentUser(),
            'informes'    => Informe::all(),
            'success'     => $this->query('success'),
            'error'       => $this->query('error'),
        ], 'panel');
    }

    /** Gestión de mensajes de contacto */

}
