<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/app/Helpers/JwtHelper.php';
require_once __DIR__ . '/app/Helpers/MailHelper.php';

use App\Helpers\JwtHelper;
use App\Helpers\MailHelper;

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    
    // Validar si el email existe en la DB
    $stmt = $conn->prepare("SELECT id, name FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Generar JWT válido por 1 hora
        $payload = [
            'user_id' => $user['id'],
            'email' => $email,
            'action' => 'password_reset'
        ];
        $token = JwtHelper::generateToken($payload, 3600);
        
        // Preparar email
        $resetLink = 'http://' . $_SERVER['HTTP_HOST'] . '/aecaum/reset-password.php?token=' . $token;
        $subject = 'Recuperación de Contraseña - ACAEUM';
        $body = "
            <h2>Hola {$user['name']},</h2>
            <p>Has solicitado restablecer tu contraseña en ACAEUM.</p>
            <p>Por favor, haz clic en el siguiente enlace para crear una nueva contraseña. Este enlace es válido por 1 hora.</p>
            <p><a href='{$resetLink}' style='padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;'>Restablecer Contraseña</a></p>
            <p>Si no solicitaste este cambio, puedes ignorar este correo.</p>
        ";
        
        if (MailHelper::sendMail($email, $subject, $body)) {
            $message = 'Te hemos enviado un correo con las instrucciones para restablecer tu contraseña.';
            $messageType = 'success';
        } else {
            $message = 'Hubo un error al enviar el correo. Por favor, intenta de nuevo más tarde.';
            $messageType = 'danger';
        }
    } else {
        // Por seguridad, no decimos que el correo no existe, damos el mismo mensaje
        $message = 'Si el correo existe en nuestro sistema, recibirás un enlace de recuperación.';
        $messageType = 'success';
    }
}
?>
<!doctype html>
<html class="no-js" lang="es">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Recuperar Contraseña - ACAEUM</title>
   <meta name="description" content="Página de recuperación de contraseña de ACAEUM">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Place favicon.ico in the root directory -->
   <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

   <!-- CSS here -->
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/slick.css">
   <link rel="stylesheet" href="assets/css/custom-animation.css">
   <link rel="stylesheet" href="assets/css/nice-select.css">
   <link rel="stylesheet" href="assets/css/swiper-bundle.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
   <link rel="stylesheet" href="assets/css/magnific-popup.css">
   <link rel="stylesheet" href="assets/css/spacing.css">
   <link rel="stylesheet" href="assets/css/main.css">

</head>

<body id="body" class="tv-magic-cursor">

   <!-- preloader -->
   <div id="preloader">
      <div class="preloader">
         <span></span>
         <span></span>
      </div>
   </div>
   <!-- preloader end  -->

   <div id="magic-cursor">
      <div id="ball"></div>
   </div>

   <!-- back-to-top-start  -->
   <button class="scroll-top scroll-to-target" data-target="html">
      <i class="ti ti-arrow-up"></i>
   </button>
   <!-- back-to-top-end  -->

   <main>

      <!-- recover-area-start -->
      <div class="tv-about-area z-index-1 p-relative pt-130 pb-130 white-bg">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-xl-6 col-lg-8">
                  <div class="tv-section-title-box text-center mb-40">
                     <h4 class="tv-section-title pb-20 tv-spltv-text tv-spltv-in-right">Recuperar Contraseña</h4>
                     <p class="tv-section">Ingresa el correo electrónico asociado a tu cuenta y te enviaremos un enlace para restablecer tu contraseña.
                     </p>
                  </div>
                  <div class="contact__form"
                     style="background-color: #f9f9f9; padding: 40px; border-radius: 10px; box-shadow: 0px 5px 20px rgba(0,0,0,0.05);">
                     <?php if($message): ?>
                        <div class="alert alert-<?php echo $messageType; ?>" style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background-color: <?php echo $messageType === 'success' ? '#d4edda' : '#f8d7da'; ?>; color: <?php echo $messageType === 'success' ? '#155724' : '#721c24'; ?>;">
                           <?php echo $message; ?>
                        </div>
                     <?php endif; ?>
                     <form action="forgot-password.php" method="POST">
                        <div class="row">
                           <div class="col-xxl-12">
                              <div class="contact__input-box mb-24">
                                 <label for="email"
                                    style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--tv-heading-primary);">Correo
                                    Electrónico</label>
                                 <input type="email" id="email" placeholder="Ingresa tu correo" name="email" required
                                    style="border: 1px solid #ddd; border-radius: 5px;">
                              </div>
                           </div>
                           <div class="col-xxl-12">
                              <div class="contact__btn text-center mt-20">
                                 <button type="submit" class="tv-btn-primary w-100"
                                    style="width: 100%; border-radius: 5px; justify-content: center; display: flex;">
                                    <span class="btn-wrap">
                                       <span class="btn-text1">Enviar Enlace</span>
                                       <span class="btn-text2">Enviar Enlace</span>
                                    </span>
                                 </button>
                              </div>
                           </div>
                           <div class="col-xxl-12 text-center mt-24" style="margin-top: 24px;">
                              <p style="margin-bottom: 0;">¿Recordaste tu contraseña? <a href="/login"
                                    style="color: var(--tv-theme-1); font-weight: 600;">Inicia sesión aquí</a></p>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- recover-area-end -->

   </main>

   <!-- JS here -->
   <script src="assets/js/jquery.js"></script>
   <script src="assets/js/bootstrap.bundle.min.js"></script>
   <script src="assets/js/slick.min.js"></script>
   <script src="assets/js/magnific-popup.js"></script>
   <script src="assets/js/purecounter.js"></script>
   <script src="assets/js/wow.js"></script>
   <script src="assets/js/nice-select.js"></script>
   <script src="assets/js/range-slider.js"></script>
   <script src="assets/js/swiper-bundle.js"></script>
   <script src="assets/js/isotope-pkgd.js"></script>
   <script src="assets/js/imagesloaded-pkgd.js"></script>
   <script src="assets/js/main-tv.js"></script>
   <script src="assets/js/custom-gsap.js"></script>
   <script src="assets/js/slider.js"></script>
   <script src="assets/js/main.js"></script>


</body>

</html>
