<!-- reset-password-area-start -->
<div class="tv-about-area z-index-1 p-relative pt-130 pb-130 white-bg">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-xl-5 col-lg-7">
            <div class="tv-section-title-box text-center mb-40">
               <h1 class="tv-section-title pb-20 tv-spltv-text tv-spltv-in-right" style="font-size:28px;">Restablecer contraseña</h1>
               <p class="tv-section">Ingresá tu nueva contraseña a continuación.</p>

               <?php if (!empty($message)): ?>
               <div style="background:#d1fae5;color:#065f46;padding:12px 20px;border-radius:8px;margin-top:16px;font-size:14px;text-align:left;">
                  <i class="ti ti-circle-check"></i> <?= htmlspecialchars($message) ?>
                  <br><br>
                  <a href="<?= APP_URL ?>/login" style="color:#065f46;font-weight:600;">← Ir al inicio de sesión</a>
               </div>
               <?php endif; ?>

               <?php if (!empty($error)): ?>
               <div style="background:#fee2e2;color:#991b1b;padding:12px 20px;border-radius:8px;margin-top:16px;font-size:14px;text-align:left;">
                  <i class="ti ti-alert-circle"></i> <?= htmlspecialchars($error) ?>
                  <?php if (!$isValid): ?>
                  <br><br>
                  <a href="<?= APP_URL ?>/recuperar-clave" style="color:#991b1b;font-weight:600;">Solicitar nuevo enlace</a>
                  <?php endif; ?>
               </div>
               <?php endif; ?>
            </div>

            <?php if ($isValid): ?>
            <div class="contact__form" style="background:#f9f9f9;padding:40px;border-radius:12px;box-shadow:0 5px 20px rgba(0,0,0,0.05);">
               <form action="<?= APP_URL ?>/reset-password" method="POST">
                  <input type="hidden" name="token" value="<?= $token ?>">
                  <div class="row">
                     <div class="col-12">
                        <div class="contact__input-box mb-24">
                           <label for="password" style="display:block;margin-bottom:8px;font-weight:600;">Nueva Contraseña</label>
                           <input type="password" id="password" name="password" placeholder="Mínimo 6 caracteres" required
                              style="border:1px solid #ddd;border-radius:6px;width:100%;padding:12px 16px;">
                        </div>
                     </div>
                     <div class="col-12">
                        <div class="contact__input-box mb-24">
                           <label for="confirm_password" style="display:block;margin-bottom:8px;font-weight:600;">Confirmar Contraseña</label>
                           <input type="password" id="confirm_password" name="confirm_password" placeholder="Repetí tu nueva contraseña" required
                              style="border:1px solid #ddd;border-radius:6px;width:100%;padding:12px 16px;">
                        </div>
                     </div>
                     <div class="col-12 text-end mb-24">
                        <a href="<?= APP_URL ?>/login" style="font-size:14px;color:var(--tv-theme-1);">
                           Volver al inicio de sesión
                        </a>
                     </div>
                     <div class="col-12">
                        <button type="submit" class="tv-btn-primary" style="width:100%;border-radius:6px;justify-content:center;display:flex;">
                           <span class="btn-wrap">
                              <span class="btn-text1">Actualizar contraseña</span>
                              <span class="btn-text2">Actualizar contraseña</span>
                           </span>
                        </button>
                     </div>
                  </div>
               </form>
            </div>
            <?php endif; ?>

         </div>
      </div>
   </div>
</div>
<!-- reset-password-area-end -->
