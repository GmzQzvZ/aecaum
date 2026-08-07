<?php include PARTIALS_PATH . '/sidebar-user.php'; ?>

<div class="main-content">
   <div class="page-header">
      <div>
         <h1><i class="ti ti-file-description"></i> Informes Institucionales</h1>
         <p>Consulta y descarga los informes institucionales disponibles</p>
      </div>
   </div>

   <div class="panel-card">
      <h3><i class="ti ti-list"></i> Lista de informes (<?= count($informes) ?>)</h3>
      <?php if (empty($informes)): ?>
      <div class="empty-state"><i class="ti ti-layout-grid-off"></i><p>No hay informes registrados aún.</p></div>
      <?php else: ?>
      <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
         <?php foreach ($informes as $inf): ?>
         <div style="border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; background: #fff;">
            <div style="height: 200px; overflow: hidden; background: #f5f6f7;">
               <img loading="lazy" src="<?= APP_URL ?>/<?= htmlspecialchars($inf['image']) ?>" alt="<?= htmlspecialchars($inf['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div style="padding: 15px;">
               <h4 style="margin: 0 0 10px 0; color: #0a3a78;"><?= htmlspecialchars($inf['title']) ?></h4>
               <p style="color: #6d8089; font-size: 14px; margin: 0 0 15px 0;">Año: <?= htmlspecialchars($inf['year']) ?></p>

               <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                  <?php if (!empty($inf['file_path'])): ?>
                  <a href="<?= APP_URL . '/' . htmlspecialchars($inf['file_path']) ?>" target="_blank" class="btn-primary-sm" style="text-decoration: none; padding: 6px 12px; display: inline-flex; align-items: center; gap: 5px; background: #0a3a78;">
                     <i class="ti ti-download"></i> Descargar
                  </a>
                  <?php elseif (!empty($inf['download_url'])): ?>
                  <a href="<?= htmlspecialchars($inf['download_url']) ?>" target="_blank" class="btn-primary-sm" style="text-decoration: none; padding: 6px 12px; display: inline-flex; align-items: center; gap: 5px; background: #0a3a78;">
                     <i class="ti ti-download"></i> Descargar
                  </a>
                  <?php endif; ?>
               </div>
            </div>
         </div>
         <?php endforeach; ?>
      </div>
      <?php endif; ?>
   </div>
</div>
