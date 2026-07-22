<?php
// ============================================================
// Controller: Auth — Autenticación de usuarios
// ============================================================

class AuthController extends BaseController {

    public function login(): void {
        // Redirigir si ya está logueado
        if (isLoggedIn()) {
            $this->redirect(hasRole('Superadmin') ? 'admin' : 'dashboard');
            return;
        }

        $error = '';

        if ($this->isPost()) {
            $email    = trim($_POST['email']    ?? '');
            $password =      $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = 'Por favor completá todos los campos.';
            } else {
                $user = User::findByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    // Generar token JWT
                    $payload = [
                        'user_id' => $user['id'],
                        'email' => $user['email'],
                        'role_name' => $user['role_name'],
                        'role_id' => $user['role_id'],
                        'action' => 'auth'
                    ];
                    
                    require_once ROOT_PATH . '/app/Helpers/JwtHelper.php';
                    $token = \App\Helpers\JwtHelper::generateToken($payload, 86400); // 24 horas

                    // Establecer cookie segura HttpOnly
                    setcookie('aecaum_token', $token, [
                        'expires' => time() + 86400,
                        'path' => '/',
                        'secure' => isset($_SERVER['HTTPS']),
                        'httponly' => true,
                        'samesite' => 'Strict'
                    ]);

                    // Redirigir según rol
                    $isAdmin = in_array($user['role_name'], ['Superadmin', 'admin']);
                    $this->redirect($isAdmin ? 'admin' : 'dashboard');
                    return;
                }

                $error = 'Credenciales incorrectas. Verificá tu email y contraseña.';
            }
        }

        $this->render('auth/login', [
            'pageTitle' => 'Iniciar Sesión | AECAUM',
            'error'     => $error,
        ]);
    }

    public function logout(): void {
        // Eliminar la cookie JWT
        setcookie('aecaum_token', '', [
            'expires' => time() - 3600,
            'path' => '/',
            'secure' => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
        
        $this->redirect('login');
    }

    public function forgotPassword(): void {
        $sent  = false;
        $error = '';

        if ($this->isPost()) {
            $email = trim($_POST['email'] ?? '');

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Por favor ingresá una dirección de email válida.';
            } else {
                $user = User::findByEmail($email);

                if ($user) {
                    // Generar JWT de reset válido por 1 hora
                    require_once ROOT_PATH . '/app/Helpers/JwtHelper.php';
                    require_once ROOT_PATH . '/app/Helpers/MailHelper.php';

                    $payload = [
                        'user_id' => $user['id'],
                        'email'   => $email,
                        'action'  => 'password_reset',
                    ];
                    $token = \App\Helpers\JwtHelper::generateToken($payload, 3600);

                    // Construir enlace de restablecimiento
                    $resetLink = APP_URL . '/reset-password?token=' . urlencode($token);

                    $subject = 'Recuperación de Contraseña — ACAEUM';
                    $body    = "
                        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>
                            <div style='background: #0a3a78; padding: 30px; text-align: center;'>
                                <img src='" . APP_URL . "/assets/img/logo/logo.png' alt='AECAUM' style='max-width: 150px; margin-bottom: 15px;'>
                                <h1 style='color: #ffffff; margin: 0; font-size: 28px; font-weight: 600;'>Recuperación de Contraseña</h1>
                            </div>
                            <div style='padding: 30px;'>
                                <p style='color: #6d8089; font-size: 16px; line-height: 1.6;'>Hola <strong style='color: #0a3a78;'>{$user['name']}</strong>,</p>
                                <p style='color: #6d8089; font-size: 16px; line-height: 1.6;'>Recibimos una solicitud para restablecer la contraseña de tu cuenta en <strong style='color: #0a3a78;'>ACAEUM</strong>.</p>
                                <p style='color: #6d8089; font-size: 16px; line-height: 1.6;'>Hacé clic en el botón para crear una nueva contraseña. El enlace es válido por <strong style='color: #00aae6;'>1 hora</strong>.</p>
                                <p style='text-align:center;margin:32px 0;'>
                                    <a href='{$resetLink}'
                                       style='background:#00aae6;color:#fff;padding:14px 32px;border-radius:6px;text-decoration:none;font-weight:600;display:inline-block;font-size:16px;'>
                                       Restablecer contraseña
                                    </a>
                                </p>
                                <div style='background: #F5F6F7; border-left: 4px solid #6d8089; padding: 15px; margin: 25px 0;'>
                                    <p style='color: #6d8089; margin: 0; font-size: 14px; line-height: 1.5;'>Si no solicitaste este cambio, podés ignorar este correo. Tu contraseña no será modificada.</p>
                                </div>
                                <hr style='border:none;border-top:1px solid #e5e7eb;margin:24px 0;'>
                                <p style='font-size:13px;color:#6d8089;margin:0;'>O copiá y pegá este enlace en tu navegador:</p>
                                <p style='font-size:12px;color:#00aae6;margin:5px 0 0 0;word-break:break-all;'>
                                    <a href='{$resetLink}' style='color:#00aae6;text-decoration:none;'>{$resetLink}</a>
                                </p>
                            </div>
                            <div style='background: #0a3a78; padding: 20px; text-align: center;'>
                                <p style='color: #ffffff; margin: 0; font-size: 12px; opacity: 0.8;'>© 2026 AECAUM. Todos los derechos reservados.</p>
                            </div>
                        </div>
                    ";

                    \App\Helpers\MailHelper::sendMail($email, $subject, $body);
                    // No revelar si el correo existe o no (seguridad)
                }

                // Siempre mostrar mensaje de éxito por seguridad
                $sent = true;
            }
        }

        $this->render('auth/forgot-password', [
            'pageTitle' => 'Recuperar Contraseña | ACAEUM',
            'sent'      => $sent,
            'error'     => $error,
        ]);
    }

    public function resetPassword(): void {
        require_once ROOT_PATH . '/app/Helpers/JwtHelper.php';

        $token   = trim($_GET['token'] ?? $_POST['token'] ?? '');
        $message = '';
        $error   = '';
        $isValid = false;
        $userId  = null;

        if (empty($token)) {
            $error = 'El enlace de recuperación es inválido o no se proporcionó.';
        } else {
            $payload = \App\Helpers\JwtHelper::verifyToken($token);

            if ($payload && isset($payload['action']) && $payload['action'] === 'password_reset') {
                $isValid = true;
                $userId  = (int) $payload['user_id'];
            } else {
                $error = 'El enlace ha expirado o es inválido. Por favor, solicitá uno nuevo.';
            }
        }

        // Procesar cambio de contraseña (POST)
        if ($this->isPost() && $isValid && $userId) {
            $password        = $_POST['password']         ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if (empty($password) || strlen($password) < 6) {
                $error   = 'La contraseña debe tener al menos 6 caracteres.';
            } elseif ($password !== $confirmPassword) {
                $error   = 'Las contraseñas no coinciden.';
            } else {
                $currentUser = User::findById($userId);
                $ok = $currentUser && User::update($userId, [
                    'password' => $password,
                    'name'     => $currentUser['name'],
                    'email'    => $currentUser['email'],
                    'role_id'  => $currentUser['role_id'],
                ]);

                if ($ok) {
                    $message = 'Tu contraseña fue actualizada correctamente.';
                    $isValid = false; // ocultar el formulario
                } else {
                    $error = 'Ocurrió un error al actualizar tu contraseña. Intentá de nuevo.';
                }
            }
        }

        $this->render('auth/reset-password', [
            'pageTitle' => 'Restablecer Contraseña | ACAEUM',
            'token'     => htmlspecialchars($token),
            'isValid'   => $isValid,
            'message'   => $message,
            'error'     => $error,
        ]);
    }
}
