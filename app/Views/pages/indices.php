<main>
   <!-- breadcrumb-area-start -->
   <div class="tv-breadcrumb-area tv-breadcrumb-overlay tv-breadcrumb-ptb z-index-1 fix p-relative"
         data-background="assets/img/breadcrumb/nosotros.png">
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
                           <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
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

         <?php if (!empty($indices)): ?>
            <!-- Header del Índice de Costos -->
            <div class="row mb-50">
               <div class="col-lg-12 text-center">
                  <span class="tv-section-subtitle" style="color: #00a3e0; font-weight: 700; font-size: 16px;">
                     <?= htmlspecialchars($indices[0]['month'] ?? 'Junio') ?>
                  </span>
                  <h2 class="tv-section-title"
                     style="font-size: 42px; font-weight: 800; color: #0b3d91; margin-bottom: 20px;">
                     <?= htmlspecialchars($indices[0]['title']) ?>
                  </h2>
                  <p style="font-size: 16px; color: #6b7280; max-width: 900px; margin: 0 auto; line-height: 1.6;">
                     <?= htmlspecialchars($indices[0]['description']) ?>
                  </p>
               </div>
            </div>

            <!-- Contenido Principal del Índice -->
            <div class="row mb-50">
               <div class="col-lg-12">
                  <div class="grafico-container">
                     <img src="<?= APP_URL ?>/<?= htmlspecialchars($indices[0]['image']) ?>"
                        alt="<?= htmlspecialchars($indices[0]['title']) ?>" style="width: 100%; border-radius: 8px;">
                  </div>
                  <?php if (!empty($indices[0]['informe'])): ?>
                     <div class="text-center mt-30">
                        <a href="<?= APP_URL ?>/<?= htmlspecialchars($indices[0]['informe']) ?>" class="btn-informe-completo"
                           target="_blank">
                           Informe Completo
                        </a>
                     </div>
                  <?php endif; ?>
               </div>
            </div>

            <!-- Tarjetas de Meses agrupadas por Año -->
            <?php if (count($indices) > 1):
               // Agrupar los registros anteriores por año
               $grouped = [];
               for ($i = 1; $i < count($indices); $i++) {
                  $yr = $indices[$i]['year'] ?? date('Y');
                  $grouped[$yr][] = $indices[$i];
               }
               // Ordenar por año descendente
               krsort($grouped);
            ?>
            <?php foreach ($grouped as $yearGroup => $items): ?>
            <div class="row mt-50">
               <div class="col-lg-12">
                  <div class="year-group-title">
                     <span class="year-line"></span>
                     <h3><?= htmlspecialchars($yearGroup) ?></h3>
                     <span class="year-line"></span>
                  </div>
                  <div class="month-cards">
                     <?php foreach ($items as $idx): ?>
                        <a href="<?= APP_URL ?>/indices?month=<?= urlencode($idx['month'] ?? '') ?>&year=<?= urlencode($idx['year'] ?? '') ?>"
                           class="month-card">
                           <div class="month-text">
                              <span class="month-name"><?= ucfirst(htmlspecialchars($idx['month'] ?? 'Mes')) ?></span>
                              <span class="month-label"><?= htmlspecialchars($idx['title'] ?? 'Índices de Costos') ?></span>
                           </div>
                           <div class="month-icon">
                              <i class="ti ti-arrow-up-right"></i>
                           </div>
                        </a>
                     <?php endforeach; ?>
                  </div>
               </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
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
   /* Título separador por año */
   .year-group-title {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-bottom: 30px;
   }

   .year-group-title h3 {
      font-size: 28px;
      font-weight: 800;
      color: #0b3d91;
      margin: 0;
      white-space: nowrap;
   }

   .year-line {
      flex: 1;
      height: 2px;
      background: linear-gradient(90deg, #00a3e0, #e5e7eb);
   }

   .year-group-title .year-line:first-child {
      background: linear-gradient(90deg, #e5e7eb, #00a3e0);
   }

   /* Botón de informe completo */
   .btn-informe-completo {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: #00A3E0;
      color: #ffffff;
      padding: 12px 35px;
      border-radius: 20px 0 20px 0;
      text-decoration: none;
      font-weight: 500;
      font-size: 18px;
      transition: all 0.3s ease;
   }

   .btn-informe-completo:hover {
      background: #008fcc;
      color: #ffffff;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 163, 224, 0.3);
   }

   /* Gráfico/Imagen container */
   .grafico-container {
      background: #ffffff;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
   }

   /* Tarjetas de meses */
   .month-cards {
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
   }

   .month-card {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px 20px;
      background: #d9eff9;
      border-radius: 30px 0 30px 0;
      text-decoration: none;
      transition: all 0.3s ease;
      width: calc(33.333% - 14px);
      min-width: 250px;
   }

   .month-card:hover {
      background: #c2e5f5;
      transform: translateY(-3px);
   }

   .month-card.active {
      background: #c2e5f5;
   }

   .month-text {
      display: flex;
      flex-direction: column;
      text-align: left;
   }

   .month-name {
      font-size: 22px;
      font-weight: 600;
      color: #00A3E0;
      line-height: 1.1;
   }

   .month-label {
      font-size: 18px;
      color: #0a3a78;
      font-weight: 500;
      margin-top: 4px;
   }

   .month-icon {
      width: 45px;
      height: 45px;
      background: #00A3E0;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #ffffff;
      font-size: 20px;
      flex-shrink: 0;
      transition: all 0.3s ease;
   }

   .month-card:hover .month-icon {
      transform: scale(1.05);
   }

   /* Responsive */
   @media (max-width: 991px) {
      .service-panel {
         margin-bottom: 20px;
      }

      .grafico-container {
         margin-top: 20px;
      }
   }

   @media (max-width: 576px) {
      .month-cards {
         flex-direction: column;
      }

      .month-card {
         width: 100%;
      }
   }
</style>