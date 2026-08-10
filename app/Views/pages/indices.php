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
                        <span><a href="<?= APP_URL ?>/home">Home</a></span>
                        <span class="dvdr">
                           <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path
                                 d="M4.47698 6.00058L0.352151 10.1253L1.53065 11.3038L6.83398 6.00058L1.53065 0.697266L0.352151 1.87577L4.47698 6.00058Z"
                                 fill="#00aae6" />
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
      <div class="container" style="text-align: center;">


         <!-- Textos introductorios -->
         <div class="row text-center mb-40">
            <div class="col-lg-12">
               <h4 class="tv-section-subtitle" style="font-size: 24px; color: #00a3e0; font-weight: 700; margin-bottom: 15px;">Informes</h4>
               <h1>Índices de Mayores Costos AECAUM</h1>
               <h2 class="tv-section-subtitle" style="font-size: 24px; color: #00a3e0; font-weight: 700; margin-bottom: 15px;">Gestión eficiente basada en evidencia técnica</h2>
               <div style="font-size: 16px; color: #6b7280; max-width: 900px; margin: 0 auto; line-height: 1.6; text-align: justify;">
                  <p>En un entorno económico dinámico, la capacidad de dimensionar con precisión el impacto de la estructura de costos es una 
                     ventaja competitiva fundamental. Desde AECAUM, desarrollamos y monitoreamos mensualmente nuestros Índices de 
                     Mayores Costos (IMC), una herramienta técnica diseñada para reflejar la realidad operativa de nuestras empresas.</p>

                  <p>Estos índices no solo sirven como referencia para la sostenibilidad de nuestros asociados, sino que garantizan una 
                     transparencia absoluta en la relación con clientes y el mercado en general.</p>

                  <p><strong>¿Cómo trabajamos nuestros índices?</strong></p>

                  <p>Nuestros indicadores son auditados y homologados por la Universidad Tecnológica Nacional (UTN) a través de su Centro 
                     Tecnológico de Transporte, Tránsito y Seguridad Vial (C3T). Esta alianza estratégica aporta el rigor científico necesario para 
                     desglosar la complejidad de nuestra cadena de valor.</p>
                  
                  <p><strong> Publicamos mensualmente dos índices específicos:</strong></p>

                  <ul style="margin-left: 30px;">
                     <li>Índice de Última Milla: Enfocado en las variables críticas que componen la logística de distribución de última instancia 
                        (combustibles, mano de obra, mantenimiento, peajes, entre otros).</li>

                     <li> Índice de Servicios Postales: Diseñado para capturar la estructura de costos específica de la operación postal tradicional.</li>
                  </ul>
               </div>
            </div>
         </div>

         <?php if (!empty($indices)): ?>
            <!-- Header del Índice de Costos -->
            <div class="row mb-50">
               <div class="col-lg-12 text-center">
                  <h2 class="tv-section-title"
                     style="font-size: 42px; font-weight: 800; color: #00a3e0; margin-bottom: 20px;">
                     <?= htmlspecialchars($indices[0]['title']) ?>
                  </h2>
               </div>
            </div>

            <!-- Contenido Principal del Índice -->
            <div class="row mb-50">
               <div class="col-lg-12">
                  <div class="grafico-container">



                     <!-- Imágenes 1 y 2 -->
                     <div class="row">
                        <div class="col-lg-6 mb-20">
                           <img loading="lazy" src="<?= APP_URL ?>/<?= htmlspecialchars($indices[0]['image']) ?>"
                              alt="Servicio Última Milla" style="width: 100%; border-radius: 8px;">
                        </div>
                        <?php if (!empty($indices[0]['image2'])): ?>
                           <div class="col-lg-6 mb-20">
                              <img loading="lazy" src="<?= APP_URL ?>/<?= htmlspecialchars($indices[0]['image2']) ?>"
                                 alt="Servicios Postales" style="width: 100%; border-radius: 8px;">
                           </div>
                        <?php endif; ?>
                     </div>

                     <!-- Texto intermedio (H6) -->
                     <div class="row mt-20 mb-30 text-center">
                        <div class="col-lg-12">
                           <h6 style="color: #0b3d91">
                              Los índices de variación de costos de los servicios de última milla y postal son homologados
                              por la Universidad<br> Tecnológica Nacional (UTN) a través de su Centro Tecnológico de
                              Transporte, Tránsito y Seguridad Vial (C3T).
                           </h6>
                           <img src="assets/img/logo/UTN.jpg" alt="UTN" style="width: 200px;">
                           <img src="assets/img/logo/C3TLogo.png" alt="C3T" style="width: 120px;">
                        </div>
                     </div>

                     <!-- Imagen 3 -->
                     <div class="row">
                        <?php if (!empty($indices[0]['image3'])): ?>
                           <div class="col-lg-12 mb-20">
                              <img loading="lazy" src="<?= APP_URL ?>/<?= htmlspecialchars($indices[0]['image3']) ?>"
                                 alt="Porcentajes" style="width: 100%; border-radius: 8px;">
                           </div>
                        <?php endif; ?>
                     </div>

                     <div class="botones-informes">
                        <?php if (!empty($indices[0]['informe_mensual'])): ?>
                           <a href="<?= APP_URL ?>/<?= htmlspecialchars($indices[0]['informe_mensual']) ?>" download
                              class="btn-informe-completo" style="color: #fff; background: #0b3d91;">
                              <i style="margin-right: 8px; font-size: 20px; color: #fff"></i>
                              Informe mensual
                           </a>
                        <?php endif; ?>
                        <?php if (!empty($indices[0]['informe'])): ?>
                           <?php $targetUrl = isLoggedIn() ? APP_URL . '/dashboard/indices' : APP_URL . '/login'; ?>
                           <a href="<?= $targetUrl ?>" class="btn-informe-completo" style="color: #fff">
                              <i style="margin-right: 8px; font-size: 20px; color: #fff"></i>
                              Informe Completo
                           </a>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
            <h4 class="text-center mt-40" style="font-weight: 700; font-size: 24px;">Descargá los IMC de los meses
               anteriores</h4>

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

               // Ordenar los meses de cada año cronológicamente (Enero a Diciembre)
               $mesesOrder = ['enero' => 1, 'febrero' => 2, 'marzo' => 3, 'abril' => 4, 'mayo' => 5, 'junio' => 6, 'julio' => 7, 'agosto' => 8, 'septiembre' => 9, 'octubre' => 10, 'noviembre' => 11, 'diciembre' => 12];
               foreach ($grouped as &$items) {
                  usort($items, function ($a, $b) use ($mesesOrder) {
                     $mA = strtolower($a['month'] ?? '');
                     $mB = strtolower($b['month'] ?? '');
                     $valA = $mesesOrder[$mA] ?? 99;
                     $valB = $mesesOrder[$mB] ?? 99;
                     return $valA <=> $valB;
                  });
               }
               unset($items);
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
                              <?php
                              $downloadUrl = !empty($idx['informe_mensual'])
                                 ? APP_URL . '/' . htmlspecialchars($idx['informe_mensual'])
                                 : (!empty($idx['image']) ? APP_URL . '/' . htmlspecialchars($idx['image']) : '#');
                              ?>
                              <a href="<?= $downloadUrl ?>" <?= $downloadUrl !== '#' ? 'download target="_blank"' : 'onclick="alert(\'Documento no disponible\'); return false;"' ?> class="month-card">
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
            <!-- Texto intermedio (H6) cuando no hay registros -->
            <div class="row mt-20 mb-40 text-center">
               <div class="col-lg-12">
                  <h6 style="color: #0b3d91">
                     Los índices de variación de costos de los servicios de última milla y postal son homologados
                     por la Universidad<br> Tecnológica Nacional (UTN) a través de su Centro Tecnológico de Transporte,
                     Tránsito y Seguridad Vial (C3T).
                  </h6>
                  <img src="assets/img/logo/UTN.jpg" alt="UTN" style="width: 200px;">
                  <img src="assets/img/logo/C3TLogo.png" alt="C3T" style="width: 120px;">
               </div>

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
            border-radius: 30px 0 30px 0;
            text-decoration: none;
            transition: all 0.3s ease;
            width: calc(33.333% - 14px);
            min-width: 250px;
         }

         .month-card:hover {
            transform: translateY(-3px);
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

            .botones-informes {
               gap: 15px;
            }
            .btn-informe-completo {
               width: 100%;
            }
         }

         /* Estilos para botones de informes */
         .botones-informes {
            display: flex;
            justify-content: center;
            gap: 200px;
            flex-wrap: wrap;
            margin-top: 20px;
         }

         @media (max-width: 991px) {
            .botones-informes {
               gap: 30px;
            }
         }
      </style>