<!-- login-area-start -->
<div class="tv-about-area z-index-1 p-relative pt-130 pb-130 white-bg">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-xl-6 col-lg-8">
            <div class="tv-section-title-box text-center mb-40">
               <h4 class="tv-section-title pb-20 tv-spltv-text tv-spltv-in-right">Acceso a tu cuenta</h4>
               <p class="tv-section">Ingresá tus credenciales para acceder a los servicios exclusivos de AECAUM.</p>
               <?php if (!empty($error)): ?>
               <div class="alert alert-danger" style="background:#f8d7da;color:#721c24;padding:12px 20px;border-radius:8px;margin-top:15px;">
                  <?= htmlspecialchars($error) ?>
               </div>
               <?php endif; ?>
            </div>
            <div class="contact__form" style="background:#f9f9f9;padding:40px;border-radius:10px;box-shadow:0 5px 20px rgba(0,0,0,0.05);">
               <form action="<?= APP_URL ?>/login" method="POST">
                  <div class="row">
                     <div class="col-xxl-12">
                        <div class="contact__input-box mb-24">
                           <label for="email" style="display:block;margin-bottom:8px;font-weight:600;">Correo Electrónico</label>
                           <input type="email" id="email" placeholder="Ingresa tu correo" name="email" required
                              style="border:1px solid #ddd;border-radius:5px;width:100%;padding:12px 16px;">
                        </div>
                     </div>
                     <div class="col-xxl-12">
                        <div class="contact__input-box mb-24">
                           <label for="password" style="display:block;margin-bottom:8px;font-weight:600;">Contraseña</label>
                           <input type="password" id="password" placeholder="Ingresa tu contraseña" name="password" required
                              style="border:1px solid #ddd;border-radius:5px;width:100%;padding:12px 16px;">
                        </div>
                     </div>
                     <div class="col-xxl-12 text-end mb-24">
                        <a href="<?= APP_URL ?>/recuperar-clave" style="font-size:14px;color:var(--tv-theme-1);">
                           ¿Olvidaste tu contraseña?
                        </a>
                     </div>
                     <div class="col-xxl-12">
                        <div class="contact__btn text-center">
                           <button type="submit" class="tv-btn-primary w-100" style="width:100%;border-radius:5px;justify-content:center;display:flex;">
                              <span class="btn-wrap">
                                 <span class="btn-text1">Ingresar</span>
                                 <span class="btn-text2">Ingresar</span>
                              </span>
                           </button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- login-area-end -->
