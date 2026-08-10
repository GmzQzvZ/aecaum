<main>
   <!-- breadcrumb-area-start -->
   <div class="tv-breadcrumb-area tv-breadcrumb-overlay tv-breadcrumb-ptb z-index-1 fix p-relative"
      data-background="assets/img/breadcrumb/nosotros.png">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="tv-breadcrumb-content z-index-1 text-center">
                  <div class="tv-breadcrumb-title-box">
                     <h3 class="tv-breadcrumb-title tv-spltv-text tv-spltv-in-right">Informes Institucionales</h3>
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
                        <i>Informes Institucionales</i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- breadcrumb-area-end -->
   <main>
      <div class="tv-about-area z-index-1 p-relative pt-130 pb-130 white-bg">
         <div class="row text-center mb-40">
            <div class="col-lg-12">
               <h4 class="tv-section-subtitle" style="font-size: 24px; color: #00a3e0; font-weight: 700; margin-bottom: 15px;">Informe</h4>
               <h1>Informe Anual de Actividad</h1>
               <h2 class="tv-section-subtitle" style="font-size: 24px; color: #00a3e0; font-weight: 700; margin-bottom: 15px;">
                  La radiografía más completa de la logística de última milla en Argentina</h2>
               <div style="font-size: 16px; color: #6b7280; max-width: 900px; margin: 0 auto; text-align: justify;">
                  <p>Aquí presentamos nuestro Informe Anual, una herramienta fundamental diseñada para entender cómo se mueve nuestra industria 
                     y cuáles son las fuerzas que están redefiniendo el mercado postal y de paquetería en el país.</p>

                  <p>Nuestros informes combinan datos oficiales con información sectorial propia, ofreciendo una visión profunda del escenario operativo, comercial y normativo actual.</p>

                  <p><strong>¿Qué encontrarás en nuestros Informes Anuales?</strong></p>

                  <p>Ya sea que busques datos para tu planificación estratégica, análisis de tendencias o información sobre el impacto regulatorio, nuestros informes cubren los pilares esenciales del sector:</p>

                  <p><strong>Diagnóstico del Mercado:</strong> Evolución histórica y real de los volúmenes de envíos, con foco en el crecimiento del e-commerce y la paquetería.</p>
                  <p><strong>Transformación Normativa:</strong> Análisis crítico sobre cómo las nuevas regulaciones impactan en la libre competencia y en la formalidad del sector.</p>
                  <p><strong>Radiografía de los Operadores:</strong> Información detallada sobre el dinamismo del Registro Nacional de Prestadores y el mapa de competencia actual.</p>
                  <p><strong>Gestión y Eficiencia:</strong> Indicadores clave (KPIs) sobre ausentismo, cobranza y dotación laboral en las empresas socias de AECAUM. </p>
                  <p><strong>Análisis de Costos:</strong>Seguimiento detallado de nuestros Índices de Mayores Costos (IMC), desglosando qué presiones afectan la rentabilidad y dónde están las oportunidades de optimización.</p>
               </div>
            </div>
         </div>
         <?php
         // Dynamic list of institucional reports
         ?>
         <div class="book-list">
            <?php if (empty($informes)): ?>
               <p>No hay informes disponibles.</p>
            <?php else: ?>
               <ul>
                  <?php foreach ($informes as $inf): ?>
                     <li>
                        <div class="book-container">
                           <div class="book">
                              <img loading="lazy" src="<?= APP_URL ?>/<?= htmlspecialchars($inf['image']) ?>"
                                 alt="<?= htmlspecialchars($inf['title']) ?>" />
                           </div>
                        </div>
                        <div class="book-info">
                           <h4><?= htmlspecialchars($inf['title']) ?></h4>
                           <p>Año: <?= htmlspecialchars($inf['year']) ?></p>
                           <?php if (!empty($inf['file_path'])): ?>
                              <a class="download-button" href="<?= APP_URL . '/' . htmlspecialchars($inf['file_path']) ?>"
                                 target="_blank" rel="nofollow">Descargar</a>
                           <?php elseif (!empty($inf['download_url'])): ?>
                              <a class="download-button" href="<?= htmlspecialchars($inf['download_url']) ?>" target="_blank"
                                 rel="nofollow">Descargar</a>
                           <?php endif; ?>
                        </div>
                     </li>
                  <?php endforeach; ?>
               </ul>
            <?php endif; ?>
         </div>

      </div>
   </main>

   <style>
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

      .btn-informe-completo {
         display: inline-flex;
         align-items: center;
         justify-content: center;
         background: #00A3E0;
         color: #fff;
         padding: 12px 35px;
         border-radius: 20px 0 20px 0;
         text-decoration: none;
         font-weight: 500;
         font-size: 18px;
         transition: all .3s ease;
      }

      .btn-informe-completo:hover {
         background: #008fcc;
         transform: translateY(-2px);
         box-shadow: 0 4px 12px rgba(0, 163, 224, .3);
      }

      .grafico-container {
         background: #fff;
         border: 1px solid #e5e7eb;
         border-radius: 12px;
         padding: 25px;
         box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
      }

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
         transition: all .3s ease;
         width: calc(33.333% - 14px);
         min-width: 250px;
      }

      .month-card:hover {
         background: #c2e5f5;
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
         color: #fff;
         font-size: 20px;
         flex-shrink: 0;
         transition: all .3s ease;
      }

      .month-card:hover .month-icon {
         transform: scale(1.05);
      }

      @media (max-width:991px) {
         .grafico-container {
            margin-top: 20px;
         }
      }

      @media (max-width:576px) {
         .month-cards {
            flex-direction: column;
         }

         .month-card {
            width: 100%;
         }
      }
   </style>