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
            if (empty($email)) {
                $error = 'Por favor ingresá tu dirección de email.';
            } else {
                // TODO: Implementar envío de email con token de recuperación
                $sent = true;
            }
        }

        $this->render('auth/forgot-password', [
            'pageTitle' => 'Recuperar Contraseña | AECAUM',
            'sent'      => $sent,
            'error'     => $error,
        ]);
    }
}
