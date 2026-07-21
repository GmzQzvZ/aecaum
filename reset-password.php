<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/app/Helpers/JwtHelper.php';

use App\Helpers\JwtHelper;

$message = '';
$messageType = '';
$token = $_GET['token'] ?? '';
$isValidToken = false;
$userId = null;

if (empty($token)) {
    $message = 'El enlace de recuperación es inválido o no se proporcionó.';
    $messageType = 'danger';
} else {
    $payload = JwtHelper::verifyToken($token);
    
    if ($payload && isset($payload['action']) && $payload['action'] === 'password_reset') {
        $isValidToken = true;
        $userId = $payload['user_id'];
    } else {
        $message = 'El enlace ha expirado o es inválido. Por favor, solicita uno nuevo.';
        $messageType = 'danger';
    }
}

// Procesar el cambio de contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isValidToken) {
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    if (empty($password) || strlen($password) < 6) {
        $message = 'La contraseña debe tener al menos 6 caracteres.';
        $messageType = 'danger';
    } elseif ($password !== $confirmPassword) {
        $message = 'Las contraseñas no coinciden.';
        $messageType = 'danger';
    } else {
        // Encriptar la nueva contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Actualizar en la base de datos
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashedPassword, $userId);
        
        if ($stmt->execute()) {
            $message = 'Tu contraseña ha sido actualizada exitosamente. <a href="login.php">Inicia sesión aquí</a>.';
            $messageType = 'success';
            $isValidToken = false; // Ocultar el formulario
        } else {
            $message = 'Hubo un error al actualizar la contraseña. Intenta de nuevo.';
            $messageType = 'danger';
        }
    }
}
?>
<!doctype html>
<html class="no-js" lang="es">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Restablecer Contraseña - ACAEUM</title>
   <meta name="description" content="Restablecer contraseña ACAEUM">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/main.css">
</head>

<body id="body" style="background-color: #f5f6f7;">
   <main>
      <div class="tv-about-area z-index-1 p-relative pt-130 pb-130">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-xl-6 col-lg-8">
                  <div class="tv-section-title-box text-center mb-40">
                     <h4 class="tv-section-title pb-20">Restablecer Contraseña</h4>
                  </div>
                  <div class="contact__form" style="background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0px 5px 20px rgba(0,0,0,0.05);">
                     
                     <?php if($message): ?>
                        <div class="alert alert-<?php echo $messageType; ?>" style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background-color: <?php echo $messageType === 'success' ? '#d4edda' : '#f8d7da'; ?>; color: <?php echo $messageType === 'success' ? '#155724' : '#721c24'; ?>;">
                           <?php echo $message; ?>
                        </div>
                     <?php endif; ?>

                     <?php if($isValidToken): ?>
                     <form action="reset-password.php?token=<?php echo htmlspecialchars($token); ?>" method="POST">
                        <div class="row">
                           <div class="col-xxl-12">
                              <div class="contact__input-box mb-24">
                                 <label for="password" style="display: block; margin-bottom: 8px; font-weight: 600;">Nueva Contraseña</label>
                                 <input type="password" id="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                              </div>
                           </div>
                           <div class="col-xxl-12">
                              <div class="contact__input-box mb-24">
                                 <label for="confirm_password" style="display: block; margin-bottom: 8px; font-weight: 600;">Confirmar Contraseña</label>
                                 <input type="password" id="confirm_password" name="confirm_password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                              </div>
                           </div>
                           <div class="col-xxl-12">
                              <div class="contact__btn text-center mt-20">
                                 <button type="submit" class="tv-btn-primary w-100" style="padding: 12px; border-radius: 5px; background-color: #007bff; color: white; border: none; cursor: pointer; font-weight: bold;">
                                    Actualizar Contraseña
                                 </button>
                              </div>
                           </div>
                        </div>
                     </form>
                     <?php endif; ?>
                     
                     <?php if(!$isValidToken && $messageType === 'danger'): ?>
                        <div class="text-center mt-20">
                           <a href="forgot-password.php" style="color: #007bff; text-decoration: underline;">Volver a intentar</a>
                        </div>
                     <?php endif; ?>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
</body>
</html>
