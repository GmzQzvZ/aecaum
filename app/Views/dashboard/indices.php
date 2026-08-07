<?php include PARTIALS_PATH . '/sidebar-user.php'; ?>

<div class="main-content">
   <div class="page-header">
      <div>
         <h1><i class="ti ti-layout-grid"></i> Índices</h1>
         <p>Consulta y descarga los índices disponibles</p>
      </div>
   </div>

   <div class="panel-card">
      <h3><i class="ti ti-list"></i> Lista de índices (<?= count($indices) ?>)</h3>
      <?php if (empty($indices)): ?>
      <div class="empty-state"><i class="ti ti-layout-grid-off"></i><p>No hay índices registrados aún.</p></div>
      <?php else: ?>
      <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
         <?php foreach ($indices as $index): ?>
         <div style="border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; background: #fff;">
            <div style="height: 200px; overflow: hidden; background: #f5f6f7;">
               <img loading="lazy" src="<?= APP_URL ?>/<?= htmlspecialchars($index['image']) ?>" alt="<?= htmlspecialchars($index['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div style="padding: 15px;">
               <h4 style="margin: 0 0 10px 0; color: #0a3a78;"><?= htmlspecialchars($index['title']) ?></h4>

               <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                  <a href="<?= APP_URL ?>/<?= htmlspecialchars($index['image']) ?>" download class="btn-primary-sm" style="text-decoration: none; padding: 6px 12px; display: inline-flex; align-items: center; gap: 5px;">
                     <i class="ti ti-download"></i> Descargar Imagen
                  </a>
                  <?php if (!empty($index['informe'])): ?>
                  <a href="<?= APP_URL ?>/<?= htmlspecialchars($index['informe']) ?>" target="_blank" class="btn-primary-sm" style="text-decoration: none; padding: 6px 12px; display: inline-flex; align-items: center; gap: 5px; background: #0a3a78;">
                     <i class="ti ti-file-download"></i> Informe Completo
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
