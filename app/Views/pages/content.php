<!-- breadcrumb-area-start -->
<div class="tv-breadcrumb-area tv-breadcrumb-overlay tv-breadcrumb-ptb z-index-1 fix p-relative"
   data-background="<?= ASSETS_URL ?>/img/breadcrumb/breadcrumb.jpg">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="tv-breadcrumb-content z-index-1 text-center">
               <div class="tv-breadcrumb-title-box">
                  <h3 class="tv-breadcrumb-title tv-spltv-text tv-spltv-in-right"><?= htmlspecialchars($sectionTitle ?? '') ?></h3>
               </div>
               <div class="tv-breadcrumb-list-wrap">
                  <div class="tv-breadcrumb-list">
                     <span><a href="<?= APP_URL ?>/">Inicio</a></span>
                     <span class="dvdr">
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M4.47698 6.00058L0.352151 10.1253L1.53065 11.3038L6.83398 6.00058L1.53065 0.697266L0.352151 1.87577L4.47698 6.00058Z" fill="#F5F6F7" />
                        </svg>
                     </span>
                     <i><?= htmlspecialchars($breadcrumb ?? $sectionTitle ?? '') ?></i>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- breadcrumb-area-end -->

<!-- content-area-start -->
<div class="tv-about-area z-index-1 p-relative pt-100 pb-100 white-bg">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-xl-8 col-lg-10">
            <div class="tv-section-title-box text-center mb-40">
               <h4 class="tv-section-title pb-20"><?= htmlspecialchars($sectionTitle ?? '') ?></h4>
               <?php if (!empty($sectionDescription)): ?>
               <p class="tv-section"><?= htmlspecialchars($sectionDescription) ?></p>
               <?php endif; ?>
            </div>
            <div class="content-placeholder" style="background:#f9f9f9;padding:40px;border-radius:12px;text-align:center;color:#666;">
               <i class="ti ti-file-text" style="font-size:48px;color:var(--tv-theme-1);margin-bottom:16px;display:block;"></i>
               <p>Esta sección está en construcción. Próximamente encontrarás aquí el contenido actualizado.</p>
               <a href="<?= APP_URL ?>/contacto" class="tv-btn-primary mt-3" style="display:inline-flex;margin-top:24px;">
                  <span class="btn-wrap">
                     <span class="btn-text1">Contactanos</span>
                     <span class="btn-text2">Contactanos</span>
                  </span>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- content-area-end -->
