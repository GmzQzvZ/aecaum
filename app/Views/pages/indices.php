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

         <?php if (!empty($indices)): ?>
         <!-- Header del Índice de Costos -->
         <div class="row mb-50">
            <div class="col-lg-12 text-center">
               <span class="tv-section-subtitle" style="color: #00a3e0; font-weight: 700; font-size: 16px;">
                  <?= htmlspecialchars($indices[0]['month'] ?? 'Junio') ?>
               </span>
               <h2 class="tv-section-title" style="font-size: 42px; font-weight: 800; color: #0b3d91; margin-bottom: 20px;">
                  <?= htmlspecialchars($indices[0]['title']) ?>
               </h2>
               <p style="font-size: 16px; color: #6b7280; max-width: 900px; margin: 0 auto; line-height: 1.6;">
                  <?= htmlspecialchars($indices[0]['description']) ?>
               </p>
            </div>
         </div>

         <!-- Contenido Principal del Índice -->
         <div class="row align-items-start mb-50">
            <!-- Columna Izquierda: Paneles de Servicios -->
            <div class="col-lg-5">
               <div class="indice-header mb-30">
                  <div class="d-flex align-items-center justify-content-between">
                     <div>
                        <h3 style="font-size: 24px; font-weight: 700; color: #0b3d91; margin: 0;">ÍNDICE DE COSTOS</h3>
                        <p style="font-size: 14px; color: #6b7280; margin: 5px 0 0 0;">
                           <?= strtoupper(htmlspecialchars($indices[0]['month'] ?? 'ABRIL')) ?> <?= htmlspecialchars($indices[0]['year'] ?? date('Y')) ?>
                        </p>
                     </div>
                     <div class="logos d-flex align-items-center gap-3">
                        <img src="<?= APP_URL ?>/assets/img/logo/aecaum.png" alt="AECAUM" style="height: 40px;">
                        <img src="<?= APP_URL ?>/assets/img/logo/utn-ct.png" alt="UTN CT" style="height: 40px;" onerror="this.style.display='none'">
                     </div>
                  </div>
               </div>

               <!-- Panel Servicio Última Milla -->
               <div class="service-panel mb-25">
                  <div class="service-panel-header">
                     <i class="ti ti-box" style="font-size: 24px; color: #0a3a78;"></i>
                     <h4 style="font-size: 18px; font-weight: 700; color: #0b3d91; margin: 0;">Servicio Última Milla</h4>
                  </div>
                  <div class="service-panel-body">
                     <div class="incidencia-badge">
                        <span class="incidencia-label">INCIDENCIA</span>
                        <span class="incidencia-value">4,42%</span>
                     </div>
                     <ul class="data-list">
                        <li>
                           <span>ACUMULADO ANUAL</span>
                           <span class="data-value">17,45%</span>
                        </li>
                        <li>
                           <span>ACUMULADO INTERANUAL</span>
                           <span class="data-value">39,54%</span>
                        </li>
                     </ul>
                  </div>
               </div>

               <!-- Panel Servicios Postales -->
               <div class="service-panel mb-25">
                  <div class="service-panel-header">
                     <i class="ti ti-mail" style="font-size: 24px; color: #0a3a78;"></i>
                     <h4 style="font-size: 18px; font-weight: 700; color: #0b3d91; margin: 0;">Servicios Postales</h4>
                  </div>
                  <div class="service-panel-body">
                     <div class="incidencia-badge">
                        <span class="incidencia-label">INCIDENCIA</span>
                        <span class="incidencia-value">5,15%</span>
                     </div>
                     <ul class="data-list">
                        <li>
                           <span>ACUMULADO ANUAL</span>
                           <span class="data-value">19,82%</span>
                        </li>
                        <li>
                           <span>ACUMULADO INTERANUAL</span>
                           <span class="data-value">42,31%</span>
                        </li>
                     </ul>
                  </div>
               </div>

               <?php if (!empty($indices[0]['informe'])): ?>
               <a href="<?= APP_URL ?>/<?= htmlspecialchars($indices[0]['informe']) ?>" class="btn-informe-completo" target="_blank">
                  <i class="ti ti-file-download"></i>
                  Informe Completo
               </a>
               <?php endif; ?>
            </div>

            <!-- Columna Derecha: Imagen del índice -->
            <div class="col-lg-7">
               <div class="grafico-container">
                  <img src="<?= APP_URL ?>/<?= htmlspecialchars($indices[0]['image']) ?>" 
                        alt="<?= htmlspecialchars($indices[0]['title']) ?>" 
                        style="width: 100%; border-radius: 8px;">
               </div>
            </div>
         </div>

         <!-- Tarjetas de Meses -->
         <div class="row mt-50">
            <div class="col-lg-12">
               <div class="month-cards">
                  <a href="<?= APP_URL ?>/indices?month=marzo&year=<?= date('Y') ?>" class="month-card <?= ($month === 'marzo') ? 'active' : '' ?>">
                     <span class="month-name">Marzo</span>
                     <span class="month-label">Índices de Costos</span>
                     <i class="ti ti-arrow-right"></i>
                  </a>
                  <a href="<?= APP_URL ?>/indices?month=abril&year=<?= date('Y') ?>" class="month-card <?= ($month === 'abril') ? 'active' : '' ?>">
                     <span class="month-name">Abril</span>
                     <span class="month-label">Índices de Costos</span>
                     <i class="ti ti-arrow-right"></i>
                  </a>
                  <a href="<?= APP_URL ?>/indices?month=mayo&year=<?= date('Y') ?>" class="month-card <?= ($month === 'mayo') ? 'active' : '' ?>">
                     <span class="month-name">Mayo</span>
                     <span class="month-label">Índices de Costos</span>
                     <i class="ti ti-arrow-right"></i>
                  </a>
               </div>
            </div>
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
/* Header del índice */
.indice-header {
   padding-bottom: 20px;
   border-bottom: 2px solid #e5e7eb;
}

.indice-header .logos img {
   object-fit: contain;
}

/* Paneles de servicio */
.service-panel {
   background: #ffffff;
   border: 1px solid #e5e7eb;
   border-radius: 12px;
   padding: 20px;
   box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
   transition: all 0.3s ease;
}

.service-panel:hover {
   box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
   transform: translateY(-2px);
}

.service-panel-header {
   display: flex;
   align-items: center;
   gap: 12px;
   margin-bottom: 15px;
   padding-bottom: 15px;
   border-bottom: 1px solid #f0f0f0;
}

.service-panel-body {
   padding: 10px 0;
}

.incidencia-badge {
   display: flex;
   justify-content: space-between;
   align-items: center;
   background: linear-gradient(135deg, #0a3a78 0%, #0b5ed8 100%);
   color: #ffffff;
   padding: 12px 16px;
   border-radius: 8px;
   margin-bottom: 15px;
}

.incidencia-label {
   font-size: 12px;
   font-weight: 600;
   letter-spacing: 0.5px;
}

.incidencia-value {
   font-size: 24px;
   font-weight: 700;
}

.data-list {
   list-style: none;
   padding: 0;
   margin: 0;
}

.data-list li {
   display: flex;
   justify-content: space-between;
   align-items: center;
   padding: 10px 0;
   border-bottom: 1px solid #f0f0f0;
   font-size: 14px;
   color: #6b7280;
}

.data-list li:last-child {
   border-bottom: none;
}

.data-value {
   font-weight: 700;
   color: #0b3d91;
   font-size: 16px;
}

/* Botón de informe completo */
.btn-informe-completo {
   display: inline-flex;
   align-items: center;
   gap: 8px;
   background: #0a3a78;
   color: #ffffff;
   padding: 14px 28px;
   border-radius: 8px;
   text-decoration: none;
   font-weight: 600;
   font-size: 15px;
   transition: all 0.3s ease;
   width: 100%;
   justify-content: center;
}

.btn-informe-completo:hover {
   background: #0b5ed8;
   transform: translateY(-2px);
   box-shadow: 0 4px 12px rgba(10, 58, 120, 0.3);
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
   flex-direction: column;
   align-items: center;
   padding: 25px 35px;
   background: #ffffff;
   border: 2px solid #e5e7eb;
   border-radius: 12px;
   text-decoration: none;
   transition: all 0.3s ease;
   min-width: 160px;
   text-align: center;
}

.month-card:hover {
   border-color: #00a3e0;
   transform: translateY(-5px);
   box-shadow: 0 6px 20px rgba(0, 163, 224, 0.25);
}

.month-card.active {
   border-color: #0a3a78;
   background: linear-gradient(135deg, #0a3a78 0%, #0b5ed8 100%);
}

.month-card.active .month-name,
.month-card.active .month-label,
.month-card.active i {
   color: #ffffff;
}

.month-name {
   font-size: 20px;
   font-weight: 700;
   color: #0b3d91;
   margin-bottom: 8px;
}

.month-label {
   font-size: 12px;
   color: #6b7280;
   margin-bottom: 12px;
   font-weight: 500;
}

.month-card i {
   font-size: 18px;
   color: #00a3e0;
   transition: transform 0.3s ease;
}

.month-card:hover i {
   transform: translateX(5px);
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
