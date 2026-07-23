<header class="tv-header-height">
   <div id="header-sticky" class="tv-header-area header-style-1 tv-header-ptb p-relative">
      <div class="container container-1750">
         <div class="p-relative">
            <div class="row align-items-center">
               <div class="col-xxl-2 col-xl-2 col-6">
                  <div class="tv-header-logo">
                     <a href="<?= APP_URL ?>/">
                        <img src="<?= ASSETS_URL ?>/img/logo/logo.png" alt="AECAUM">
                     </a>
                  </div>
               </div>
               <div class="col-xxl-7 col-xl-7 d-none d-xl-block">
                  <div class="tv-header-menu tv-header-dropdown">
                  </div>
               </div>
               <div class="col-xxl-3 col-xl-3 col-6">
                  <div class="tv-header-right-action d-flex justify-content-end align-items-center">
                     <a href="https://www.linkedin.com/company/aeca-correos-privados/" target="_blank" class="social">
                        <i class="ti ti-brand-linkedin"></i>
                     </a>
                     <span class="separator">|</span>
                     <a href="https://www.instagram.com/aecaum.ultimamilla/?hl=es" target="_blank" class="social">
                        <i class="ti ti-brand-instagram"></i>
                     </a>
                     <span class="separator">|</span>
                     <?php if (isLoggedIn()): ?>
                        <a href="<?= APP_URL ?>/dashboard" class="tv-btn-primary d-none d-md-block">
                           <span class="btn-wrap">
                              <span class="btn-text1">Mi panel</span>
                              <span class="btn-text2">Mi panel</span>
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
                     <span class="separator">|</span>
                     <div class="tv-header-bar">
                        <button class="tv-menu-bar">
                           <span><i class="ti ti-menu-2"></i></span>
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
            <button class="close-btn"><i class="ti ti-x"></i></button>
         </div>
         <div class="itoffcanvas__text">
            <nav class="menu">
               <ul>
                  <li><a href="<?= APP_URL ?>/nosotros">Nosotros</a></li>
                  <li>
                     <a href="<?= APP_URL ?>/legislacion/marco-regulatorio">Legislación y asuntos laborales</a>
                     <ul class="submenu">
                        <li><a href="<?= APP_URL ?>/legislacion/marco-regulatorio">Marco regulatorio</a></li>
                        <li><a href="<?= APP_URL ?>/legislacion/reforma-laboral">Reforma laboral</a></li>
                        <li><a href="<?= APP_URL ?>/legislacion/convenios-colectivos">Convenios colectivos, paritarias y escalas salariales</a></li>
                        <li><a href="<?= APP_URL ?>/legislacion/novedades-enacom">Novedades ENACOM</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="<?= APP_URL ?>/indices">Índices</a>
                     <ul class="submenu">
                        <li><a href="<?= APP_URL ?>/indices/imc">IMC</a></li>
                        <li><a href="<?= APP_URL ?>/indices/informes-institucionales">Informes Institucionales</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="<?= APP_URL ?>/prensa/eventos-institucionales">Prensa y Relaciones Institucionales</a>
                     <ul class="submenu">
                        <li><a href="<?= APP_URL ?>/prensa/eventos-institucionales">Eventos Institucionales</a></li>
                        <li><a href="<?= APP_URL ?>/prensa/aecaum-en-los-medios">AECAUM en los medios</a></li>
                     </ul>
                  </li>
                  <li><a href="<?= APP_URL ?>/proyectos">Conciencia Sustentable</a></li>
                  <li class="destacado"><a href="https://correos.org.ar/asociados/" target="_blank">Asociate</a></li>
                  <li><a href="<?= APP_URL ?>/contacto">Contacto</a></li>
               </ul>
            </nav>
         </div>
      </div>
   </div>
</div>