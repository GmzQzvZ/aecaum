<!-- breadcrumb-area-start -->
<div class="tv-breadcrumb-area tv-breadcrumb-overlay tv-breadcrumb-ptb z-index-1 fix p-relative"
   data-background="assets/img/breadcrumb/nosotros.png">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="tv-breadcrumb-content z-index-1 text-center">
               <div class="tv-breadcrumb-title-box">
                  <h3 class="tv-breadcrumb-title tv-spltv-text tv-spltv-in-right">Contacto</h3>
               </div>
               <div class="tv-breadcrumb-list-wrap">
                  <div class="tv-breadcrumb-list">
                     <span><a href="<?= APP_URL ?>/home">Home</a></span>
                     <span class="dvdr">
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path
                              d="M4.47698 6.00058L0.352151 10.1253L1.53065 11.3038L6.83398 6.00058L1.53065 0.697266L0.352151 1.87577L4.47698 6.00058Z"
                              fill="#F5F6F7" />
                        </svg>
                     </span>
                     <i>Contacto</i>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- breadcrumb-area-end -->

<!-- CTA-area-start -->
<div class="tv-cta-area pt-130 pb-130"
   style="background-image: url(assets/img/contact/Contacto.png); min-height: 700px;">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-xxl-7 col-xl-6 col-lg-6 col-md-5">
            <div class="video-play-btn-area p-relative">
               <div class="tv-video-icon">
                  <img loading="lazy" src="">
               </div>
            </div>
         </div>
         <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-7 p-relative">
            <div class="cta-form">
               <h2>Ponete en contacto</h2>
               <p>Comunicate con la cámara para conocer más
                  sobre nuestras membresías, solicitar información o
                  realizar una consulta institucional.</p>
               <div class="tv-contact-select">
                  <div id="contact-result">
                     <?php if ($this->query('contact_sent') === 'true'): ?>
                        <div
                           style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                           <strong>¡Mensaje enviado!</strong> Nos pondremos en contacto contigo pronto.
                        </div>
                     <?php endif; ?>

                     <?php if ($this->query('contact_error')): ?>
                        <div
                           style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                           <strong>Error:</strong> <?= htmlspecialchars($this->query('contact_error')) ?>
                        </div>
                     <?php endif; ?>
                  </div>

                  <form id="home-contact-form" action="<?= APP_URL ?>/contact" method="POST">
                     <div class="it-contact-input-box mb-20">
                        <input type="text" name="name" placeholder="Nombre *" required>
                     </div>
                     <div class="it-contact-input-box mb-20">
                        <input type="email" name="email" placeholder="eMail *" required>
                     </div>
                     <div class="it-contact-textarea-box ">
                        <textarea name="message" placeholder="Escribí tu mensaje *" required></textarea>
                     </div>
                     <div class="it-contact-sumbit-box cta">
                        <button type="submit" class="tv-btn-secondary p-relative">
                           <span class="btn-wrap">
                              <span class="btn-text1">Enviar Mensaje</span>
                              <span class="btn-text2">Enviar Mensaje</span>
                           </span>
                        </button>
                     </div>
                  </form>

                  <script>
                     (function () {
                        var form = document.getElementById('home-contact-form');
                        var result = document.getElementById('contact-result');
                        if (!form) return;

                        form.addEventListener('submit', function (e) {
                           e.preventDefault();
                           var fd = new FormData(form);

                           fetch('<?= APP_URL ?>/contact', {
                              method: 'POST',
                              body: fd,
                              headers: {
                                 'X-Requested-With': 'XMLHttpRequest'
                              }
                           }).then(function (resp) {
                              return resp.json();
                           }).then(function (json) {
                              if (json.sent) {
                                 result.innerHTML = '<div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;"><strong>¡Mensaje enviado!</strong> Nos pondremos en contacto contigo pronto.</div>';
                                 form.reset();
                              } else {
                                 result.innerHTML = '<div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;"><strong>Error:</strong> ' + (json.error || 'Hubo un error') + '</div>';
                              }
                           }).catch(function (err) {
                              result.innerHTML = '<div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;"><strong>Error:</strong> Error de conexión</div>';
                           });
                        });
                     })();
                  </script>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>
<!-- CTA-area-end -->
<!-- google map start -->
<div class="tv-google-map wow itfadeUp" data-wow-delay=".2s">
   <iframe class="tv-map"
      src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d821.9348816946364!2d-58.5303322!3d-34.5094872!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcb10066c1e51d%3A0x1ff21cb3914e7eb7!2sAECAUM!5e0!3m2!1ses-419!2sco!4v1784129344624!5m2!1ses-419!2sco"
      style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<!-- google map end -->