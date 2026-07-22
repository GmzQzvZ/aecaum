<main>
   <!-- breadcrumb-area-start -->
   <div class="tv-breadcrumb-area tv-breadcrumb-overlay tv-breadcrumb-ptb z-index-1 fix p-relative"
      data-background="assets/img/breadcrumb/breadcrumb.jpg">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="tv-breadcrumb-content z-index-1 text-center">
                  <div class="tv-breadcrumb-title-box">
                     <h3 class="tv-breadcrumb-title tv-spltv-text tv-spltv-in-right">Índices</h3>
                  </div>
                  <div class="tv-breadcrumb-list-wrap">
                     <div class="tv-breadcrumb-list">
                        <span><a href="<?= APP_URL ?>">Inicio</a></span>
                        <span class="dvdr">
                           <svg width="7" height="12" viewBox="0 0 7 12" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                 d="M4.47698 6.00058L0.352151 10.1253L1.53065 11.3038L6.83398 6.00058L1.53065 0.697266L0.352151 1.87577L4.47698 6.00058Z"
                                 fill="#F5F6F7" />
                           </svg>
                        </span>
                        <i>Índices</i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- breadcrumb-area-end -->

   <!-- indices-area-start -->
   <div class="tv-about-area z-index-1 p-relative pt-130 pb-130 white-bg">
      <div class="container">
         <!-- <div class="row">
            <div class="col-lg-12">
               <div class="tv-section-title-box mb-50">
                  <h3 class="tv-section-title">Índices AECAUM</h3>
                  <p class="tv-section-subtitle">Información actualizada sobre índices de costos y métricas del sector</p>
               </div>
            </div>
         </div> -->

         <?php if (!empty($indices)): ?>
         <div class="row justify-content-center">
            <?php foreach ($indices as $index): ?>
            <div class="col-lg-6 mb-30">
               <div class="tv-service-item-2 z-index-1 p-relative transition-3">
                  <div class="tv-service-content-2 text-center">
                     <h4 class="tv-service-title"><?= htmlspecialchars($index['title']) ?></h4>
                     <p class="tv-service-text-2"><?= htmlspecialchars($index['description']) ?></p>
                  </div>
                  <div class="tv-service-thumb-2 text-center">
                     <img src="<?= APP_URL ?>/<?= htmlspecialchars($index['image']) ?>" alt="<?= htmlspecialchars($index['title']) ?>">
                  </div>
               </div>
            </div>
            <?php endforeach; ?>
         </div>
         <?php else: ?>
         <div class="row">
            <div class="col-lg-12">
               <div class="empty-state text-center">
                  <i class="ti ti-layout-grid-off" style="font-size: 48px; color: #9ca3af;"></i>
                  <p style="color: #6d8089; margin-top: 15px;">No hay índices publicados aún.</p>
               </div>
            </div>
         </div>
         <?php endif; ?>

         <div class="row mt-50">
            <div class="col-lg-12 text-center">
               <div class="tv-hashtag">
                  <span>#SomosLaÚltimaMilla</span>
               </div>
            </div>
         </div>

         <!-- Botones de meses -->
         <div class="row mt-50">
            <div class="col-lg-12">
               <div class="tv-month-buttons text-center">
                                    <a href="<?= APP_URL ?>/indices?month=marzo&year=<?= $year ?: date('Y') ?>" class="tv-month-btn <?= ($this->query('month') === 'marzo' || !$this->query('month')) ? 'active' : '' ?>">
                     <span class="tv-month-name">Marzo</span>
                     <span class="tv-month-label">Índices de Costos</span>
                     <i class="ti ti-arrow-right"></i>
                  </a>
                  <a href="<?= APP_URL ?>/indices?month=abril&year=<?= $year ?: date('Y') ?>" class="tv-month-btn <?= ($this->query('month') === 'abril') ? 'active' : '' ?>">
                     <span class="tv-month-name">Abril</span>
                     <span class="tv-month-label">Índices de Costos</span>
                     <i class="ti ti-arrow-right"></i>
                  </a>
                  <a href="<?= APP_URL ?>/indices?month=mayo&year=<?= $year ?: date('Y') ?>" class="tv-month-btn <?= ($this->query('month') === 'mayo') ? 'active' : '' ?>">
                     <span class="tv-month-name">Mayo</span>
                     <span class="tv-month-label">Índices de Costos</span>
                     <i class="ti ti-arrow-right"></i>
                  </a>
                  <a href="<?= APP_URL ?>/indices?month=junio&year=<?= $year ?: date('Y') ?>" class="tv-month-btn <?= ($this->query('month') === 'junio') ? 'active' : '' ?>">
                     <span class="tv-month-name">Junio</span>
                     <span class="tv-month-label">Índices de Costos</span>
                     <i class="ti ti-arrow-right"></i>
                  </a>
               </div>
            </div>
         </div>

         <!-- Selector de año -->
         <div class="row mt-30">
            <div class="col-lg-12 text-center">
               <div class="tv-year-selector">
                  <label for="year-select" style="margin-right: 10px; color: #6d8089;">Año:</label>
                  <select id="year-select" onchange="changeYear(this.value)" style="padding: 8px 15px; border: 2px solid #e5e7eb; border-radius: 6px; color: #0a3a78;">
                     <option value="2024" <?= ($year == '2024' || (!$year && date('Y') == '2024')) ? 'selected' : '' ?>>2024</option>
                     <option value="2025" <?= ($year == '2025') ? 'selected' : '' ?>>2025</option>
                     <option value="2026" <?= ($year == '2026' || (!$year && date('Y') == '2026')) ? 'selected' : '' ?>>2026</option>
                     <option value="2027" <?= ($year == '2027') ? 'selected' : '' ?>>2027</option>
                     <option value="2028" <?= ($year == '2028') ? 'selected' : '' ?>>2028</option>
                  </select>
               </div>
            </div>
         </div>

<script>
function changeYear(year) {
   const currentMonth = '<?= $month ?: 'marzo' ?>';
   window.location.href = '<?= APP_URL ?>/indices?month=' + currentMonth + '&year=' + year;
}
</script>
      </div>
   </div>
   <!-- indices-area-end -->

   <!-- cta-area-start -->
   <div class="tv-cta-area z-index-1 p-relative pt-100 pb-100">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="tv-cta-content text-center">
                  <h3 class="tv-cta-title">¿Necesás más información?</h3>
                  <p class="tv-cta-text">Contactanos para obtener informes completos y detallados.</p>
                  <a href="<?= APP_URL ?>/contacto" class="tv-primary-btn">Contactar</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- cta-area-end -->
</main>

<style>
.tv-month-buttons {
   display: flex;
   justify-content: center;
   gap: 20px;
   flex-wrap: wrap;
}

.tv-month-btn {
   display: flex;
   flex-direction: column;
   align-items: center;
   padding: 20px 30px;
   background: #ffffff;
   border: 2px solid #e5e7eb;
   border-radius: 8px;
   text-decoration: none;
   transition: all 0.3s ease;
   min-width: 150px;
}

.tv-month-btn:hover {
   border-color: #00aae6;
   transform: translateY(-5px);
   box-shadow: 0 4px 12px rgba(0, 170, 230, 0.2);
}

.tv-month-btn.active {
   border-color: #0a3a78;
   background: #0a3a78;
}

.tv-month-btn.active .tv-month-name,
.tv-month-btn.active .tv-month-label,
.tv-month-btn.active i {
   color: #ffffff;
}

.tv-month-name {
   font-size: 18px;
   font-weight: 600;
   color: #0a3a78;
   margin-bottom: 5px;
}

.tv-month-label {
   font-size: 12px;
   color: #6d8089;
   margin-bottom: 10px;
}

.tv-month-btn i {
   font-size: 16px;
   color: #00aae6;
   transition: transform 0.3s ease;
}

.tv-month-btn:hover i {
   transform: translateX(5px);
}
</style>
