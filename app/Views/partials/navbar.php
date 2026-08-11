<header class="tv-header-height">
   <div id="header-sticky" class="tv-header-area header-style-1 tv-header-ptb p-relative">
      <div class="container" style="max-width: 1326px;">
         <div class="p-relative">
            <div class="row align-items-center">
               <div class="col-12 d-flex justify-content-between align-items-center gap-2 gap-md-5">
                  <div class="tv-header-logo">
                     <a href="<?= APP_URL ?>/"  >
                        <img loading="lazy" src="<?= ASSETS_URL ?>/img/logo/Logoyfondo2.png" alt="AECAUM"
                           class="tv-header-logo-img">
                     </a>
                  </div>
                  <div
                     class="tv-header-right-action d-flex justify-content-end justify-content-md-center align-items-center">
                     <a href="https://www.linkedin.com/company/aeca-correos-privados/" target="_blank"
                        class="social d-none d-md-inline-block">
                        <i class="ti ti-brand-linkedin"></i>
                     </a>
                     <span class="separator d-none d-md-inline-block" style="color: #00aae6 !important;">•</span>
                     <a href="https://www.instagram.com/aecaum.ultimamilla/?hl=es" target="_blank"
                        class="social d-none d-md-inline-block">
                        <i class="ti ti-brand-instagram"></i>
                     </a>
                     <span class="separator d-none d-md-inline-block" style="color: #00aae6 !important;">|</span>
                     <?php
                     if (isLoggedIn()):
                        $currentUser = getCurrentUser();
                        $userName = $currentUser['name'] ?? 'Mi panel';
                        ?>
                        <a href="<?= APP_URL ?>/dashboard" class="tv-btn-primary d-none d-md-block">
                           <span class="btn-wrap" style="white-space: nowrap;">
                              <span class="btn-text">Hola, <?= htmlspecialchars($userName) ?></span>
                           </span>
                        </a>
                     <?php else: ?>
                        <a href="<?= APP_URL ?>/login" class="tv-btn-primary d-none d-md-block">
                           <span class="btn-wrap">
                              <span class="btn-text1">Login</span>
                              <span class="btn-text2">Login</span>
                           </span>
                        </a>
                     <?php endif; ?>
                     <span class="separator"
                        style="font-size: 22px; margin: 0 10px; color: #00aae6 !important;">|</span>
                     <div class="tv-header-bar">
                        <button class="tv-menu-bar" type="button">
                           <span class="menu-icon" style="color: #00aae6 !important;"><i id="menu-toggle-icon"
                                 class="ti ti-menu-2"></i></span>
                           <span class="menu-text" style="color: #00aae6 !important;">Menú</span>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</header>

<!-- Offcanvas Menu -->
<div class="tv-offcanvas-area">
   <div class="itoffcanvas">
      <div class="itoffcanvas__left-image"></div>
      <div class="itoffcanvas__right-content">
         <div class="itoffcanvas__close-btn">
            <button id="offcanvas-close" type="button" aria-label="Cerrar menú">
               <i class="ti ti-x"></i>
            </button>
         </div>
         <div class="itoffcanvas__text">
            <nav class="menu">
               <ul>
                  <li><a href="<?= APP_URL ?>/nosotros">Nosotros</a></li>
                  <!-- <li>
                     <a href="<?= APP_URL ?>/legislacion/marco-regulatorio">Legislación y asuntos laborales</a>
                     <ul class="submenu">
                        <li><a href="<?= APP_URL ?>/legislacion/marco-regulatorio">Marco regulatorio</a></li>
                        <li><a href="<?= APP_URL ?>/legislacion/reforma-laboral">Reforma laboral</a></li>
                        <li><a href="<?= APP_URL ?>/legislacion/convenios-colectivos">Convenios colectivos, paritarias y
                              escalas salariales</a></li>
                        <li><a href="<?= APP_URL ?>/legislacion/novedades-enacom">Novedades ENACOM</a></li>
                     </ul>
                  </li> -->
                  <li>
                     <a href="<?= APP_URL ?>/indices">Índices</a>
                     <ul class="submenu">
                        <!-- <li><a href="<?= APP_URL ?>/indices">IMC</a></li> -->
                        <li><a href="<?= APP_URL ?>/informes-institucionales">Informes Institucionales</a></li>
                     </ul>
                  </li>
                  <!-- <li>
                     <a href="<?= APP_URL ?>/prensa/eventos-institucionales">Prensa y Relaciones Institucionales</a>
                     <ul class="submenu">
                        <li><a href="<?= APP_URL ?>/prensa/eventos-institucionales">Eventos Institucionales</a></li>
                        <li><a href="<?= APP_URL ?>/prensa/aecaum-en-los-medios">AECAUM en los medios</a></li>
                     </ul>
                  </li> -->
                  <!-- <li><a href="<?= APP_URL ?>/proyectos">Conciencia Sustentable</a></li> -->
                  <li class="destacado"><a href="https://correos.org.ar/asociados/" target="_blank">Asociate</a></li>
                  <li><a href="<?= APP_URL ?>/contacto">Contacto</a></li>
               </ul>
            </nav>
            <div class="offcanvas-mobile-extras d-block d-md-none mt-40">
               <?php
               if (isLoggedIn()):
                  $currentUser = getCurrentUser();
                  $userName = $currentUser['name'] ?? 'Mi panel';
                  ?>
                  <a href="<?= APP_URL ?>/dashboard" class="tv-btn-primary mb-30"
                     style="display: block; text-align: center; border-radius: 8px;">
                     <span class="btn-wrap" style="display: inline-block;">
                        <span class="btn-text">Hola, <?= htmlspecialchars($userName) ?></span>
                     </span>
                  </a>
               <?php else: ?>
                  <a href="<?= APP_URL ?>/login" class="tv-btn-primary mb-30"
                     style="display: block; text-align: center; border-radius: 8px;">
                     <span class="btn-wrap" style="display: inline-block;">
                        <span class="btn-text">Login</span>
                     </span>
                  </a>
               <?php endif; ?>
               <div class="offcanvas-socials" style="display: flex; justify-content: center; gap: 20px;">
                  <a href="https://www.linkedin.com/company/aeca-correos-privados/" target="_blank" class="social">
                     <i class="ti ti-brand-linkedin" style="font-size: 32px; color: #00aae6;"></i>
                  </a>
                  <a href="https://www.instagram.com/aecaum.ultimamilla/?hl=es" target="_blank" class="social">
                     <i class="ti ti-brand-instagram" style="font-size: 32px; color: #00aae6;"></i>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>