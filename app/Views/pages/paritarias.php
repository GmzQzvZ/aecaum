<main>
   <div class="tv-breadcrumb-area tv-breadcrumb-overlay tv-breadcrumb-ptb z-index-1 fix p-relative"
      data-background="assets/img/breadcrumb/nosotros.png">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="tv-breadcrumb-content z-index-1 text-center">
                  <div class="tv-breadcrumb-title-box">
                     <h3 class="tv-breadcrumb-title tv-spltv-text tv-spltv-in-right">Paritarias</h3>
                  </div>
                  <div class="tv-breadcrumb-list-wrap">
                     <div class="tv-breadcrumb-list">
                        <span><a href="<?= APP_URL ?>/home">Home</a></span>
                        <span class="dvdr">
                           <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M4.47698 6.00058L0.352151 10.1253L1.53065 11.3038L6.83398 6.00058L1.53065 0.697266L0.352151 1.87577L4.47698 6.00058Z" fill="#00aae6" />
                           </svg>
                        </span>
                        <i>Paritarias</i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <section class="tv-about-area z-index-1 p-relative pt-130 pb-130 white-bg">
      <div class="container">
         <div class="paritarias-intro">
            <h2>Documentación paritaria</h2>
            <p>Consultá las planillas salariales y los acuerdos paritarios organizados por año y mes.</p>
         </div>

         <?php if (empty($documentsByYear)): ?>
            <div class="paritarias-empty">No hay documentos disponibles por el momento.</div>
         <?php else: ?>
            <div class="paritarias-years">
               <?php foreach ($documentsByYear as $year => $categories): ?>
                  <?php $cardId = 'paritarias-' . (int) $year; ?>
                  <details class="paritaria-year-card" name="paritarias-years" <?= (int) $year === (int) array_key_first($documentsByYear) ? 'open' : '' ?>>
                     <summary class="paritaria-year-summary">
                        <span><?= (int) $year ?></span>
                        <i class="ti ti-chevron-down" aria-hidden="true"></i>
                     </summary>
                     <div class="paritaria-tabs" role="tablist" aria-label="Documentos de <?= (int) $year ?>">
                        <button type="button" class="paritaria-tab is-active" id="<?= $cardId ?>-tab-planillas"
                           role="tab" aria-selected="true" aria-controls="<?= $cardId ?>-panel-planillas"
                           data-paritaria-tab="<?= $cardId ?>-panel-planillas">Planillas salariales</button>
                        <button type="button" class="paritaria-tab" id="<?= $cardId ?>-tab-acuerdos"
                           role="tab" aria-selected="false" aria-controls="<?= $cardId ?>-panel-acuerdos"
                           data-paritaria-tab="<?= $cardId ?>-panel-acuerdos" tabindex="-1">Acuerdos paritarios</button>
                     </div>
                     <div class="paritaria-panel" id="<?= $cardId ?>-panel-planillas" role="tabpanel"
                        aria-labelledby="<?= $cardId ?>-tab-planillas">
                        <?php if (empty($categories['planillas_salariales'])): ?>
                           <p class="paritaria-no-documents">No hay planillas salariales cargadas para este año.</p>
                        <?php else: ?>
                           <ul>
                              <?php foreach ($categories['planillas_salariales'] as $document): ?>
                                 <li>
                                    <span><i class="ti ti-file-type-pdf" aria-hidden="true"></i> <?= htmlspecialchars($document['title'], ENT_QUOTES, 'UTF-8') ?></span>
                                    <a href="<?= APP_URL ?>/<?= htmlspecialchars($document['document_path'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">Ver documento</a>
                                 </li>
                              <?php endforeach; ?>
                           </ul>
                        <?php endif; ?>
                     </div>
                     <div class="paritaria-panel" id="<?= $cardId ?>-panel-acuerdos" role="tabpanel"
                        aria-labelledby="<?= $cardId ?>-tab-acuerdos" hidden>
                        <?php if (empty($categories['acuerdos_paritarios'])): ?>
                           <p class="paritaria-no-documents">No hay acuerdos paritarios cargados para este año.</p>
                        <?php else: ?>
                           <ul>
                              <?php foreach ($categories['acuerdos_paritarios'] as $document): ?>
                                 <li>
                                    <span><i class="ti ti-file-type-pdf" aria-hidden="true"></i> <?= htmlspecialchars($document['title'], ENT_QUOTES, 'UTF-8') ?></span>
                                    <div class="paritaria-document-links">
                                       <a href="<?= APP_URL ?>/<?= htmlspecialchars($document['document_path'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">Ver acuerdo</a>
                                       <?php if (!empty($document['homologacion_path'])): ?>
                                          <a href="<?= APP_URL ?>/<?= htmlspecialchars($document['homologacion_path'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">Ver homologación</a>
                                       <?php endif; ?>
                                    </div>
                                 </li>
                              <?php endforeach; ?>
                           </ul>
                        <?php endif; ?>
                     </div>
                  </details>
               <?php endforeach; ?>
            </div>
         <?php endif; ?>
      </div>
   </section>
</main>

<style>
.paritarias-intro{text-align:center;margin:0 auto 38px;max-width:760px}.paritarias-intro h2{color:#0a3a78;font-size:30px;font-weight:700;margin:0 0 10px}.paritarias-intro p{color:#6d8089;font-size:16px;margin:0}.paritarias-years{display:flex;flex-direction:column;gap:14px}.paritaria-year-card{overflow:hidden;border:1px solid #e5e7eb;border-radius:12px;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.05)}.paritaria-year-summary{display:flex;align-items:center;justify-content:space-between;padding:18px 22px;background:#0a3a78;color:#fff;font-size:24px;font-weight:700;cursor:pointer;list-style:none}.paritaria-year-summary::-webkit-details-marker{display:none}.paritaria-year-summary::marker{content:""}.paritaria-year-summary i{color:#fff;font-size:22px;transition:transform .2s}.paritaria-year-card[open]>.paritaria-year-summary i{transform:rotate(180deg)}.paritaria-year-summary:focus-visible{outline:3px solid #00a3e0;outline-offset:-3px}.paritaria-tabs{display:flex;border-bottom:1px solid #e5e7eb;background:#f8fafc}.paritaria-tab{flex:1;padding:13px 10px;border:0;border-bottom:3px solid transparent;background:transparent;color:#6d8089;font-size:14px;font-weight:600;cursor:pointer;transition:color .2s,border-color .2s}.paritaria-tab:hover,.paritaria-tab.is-active{border-bottom-color:#00a3e0;color:#0a3a78}.paritaria-panel{padding:10px 20px 16px}.paritaria-panel ul{margin:0;padding:0;list-style:none}.paritaria-panel li{display:flex;align-items:center;justify-content:space-between;gap:14px;padding:13px 0;border-bottom:1px solid #edf0f2;color:#0a3a78;font-size:14px}.paritaria-panel li:last-child{border-bottom:0}.paritaria-panel li span{display:flex;align-items:center;gap:8px;min-width:0}.paritaria-panel li span i{color:#00a3e0;font-size:19px;flex-shrink:0}.paritaria-panel li a{flex-shrink:0;color:#00a3e0;font-size:13px;font-weight:600;text-decoration:none}.paritaria-document-links{display:flex;flex-shrink:0;gap:0}.paritaria-document-links a:first-child{padding-right:16px}.paritaria-document-links a+a{padding-left:16px;border-left:1px solid #d9e0e5}.paritaria-panel li a:hover{text-decoration:underline}.paritaria-no-documents,.paritarias-empty{color:#6d8089;font-size:15px;text-align:center}.paritaria-no-documents{margin:12px 0}.paritarias-empty{padding:35px 20px;border:1px solid #e5e7eb;border-radius:12px;background:#fff}@media(max-width:576px){.paritarias-intro h2{font-size:25px}.paritaria-year-summary{font-size:21px}.paritaria-tabs{flex-direction:column}.paritaria-tab{padding:11px;border-bottom-width:1px;border-left:3px solid transparent}.paritaria-tab:hover,.paritaria-tab.is-active{border-bottom-color:#e5e7eb;border-left-color:#00a3e0}.paritaria-panel li{align-items:flex-start;flex-direction:column;gap:8px}.paritaria-document-links{flex-wrap:wrap}}
</style>

<script>
document.addEventListener('click', function (event) {
   const tab = event.target.closest('[data-paritaria-tab]');
   if (!tab) return;
   const card = tab.closest('.paritaria-year-card');
   card.querySelectorAll('[data-paritaria-tab]').forEach(function (item) {
      const active = item === tab;
      item.classList.toggle('is-active', active);
      item.setAttribute('aria-selected', active ? 'true' : 'false');
      item.tabIndex = active ? 0 : -1;
      card.querySelector('#' + item.dataset.paritariaTab).hidden = !active;
   });
});

document.querySelectorAll('.paritaria-year-card').forEach(function (yearCard) {
   yearCard.addEventListener('toggle', function () {
      if (!yearCard.open) return;
      document.querySelectorAll('.paritaria-year-card').forEach(function (otherCard) {
         if (otherCard !== yearCard) otherCard.open = false;
      });
   });
});
</script>
