<?php include PARTIALS_PATH . '/sidebar-user.php'; ?>

<div class="main-content">
   <div class="page-header">
      <div>
         <h1><i class="ti ti-dashboard"></i> Mi Panel</h1>
         <p>Bienvenido, <?= htmlspecialchars($currentUser['name']) ?></p>
      </div>
   </div>

   <div class="stats-grid">
      <div class="stat-card">
         <div class="stat-number"><?= $stats['documents'] ?></div>
         <div class="stat-label"><i class="ti ti-files"></i> Documentos disponibles</div>
      </div>
   </div>

   <div class="panel-card">
      <h3><i class="ti ti-files"></i> Documentos recientes</h3>
      <?php if (empty($documents)): ?>
      <div class="empty-state"><i class="ti ti-file-off"></i><p>No hay documentos disponibles para tu cuenta aún.</p></div>
      <?php else: ?>
      <table>
         <thead>
            <tr><th>Título</th><th>Archivo</th><th>Fecha</th><th>Acciones</th></tr>
         </thead>
         <tbody>
            <?php foreach (array_slice($documents, 0, 10) as $doc): ?>
            <tr>
               <td><strong><?= htmlspecialchars($doc['title']) ?></strong>
                  <?php if ($doc['description']): ?>
                  <br><small style="color:#9ca3af;"><?= htmlspecialchars($doc['description']) ?></small>
                  <?php endif; ?>
               </td>
               <td><i class="ti ti-file"></i> <?= htmlspecialchars($doc['filename']) ?></td>
               <td><?= date('d/m/Y', strtotime($doc['created_at'])) ?></td>
               <td style="display:flex;gap:6px;">
                  <a href="<?= APP_URL ?>/documento/ver?id=<?= $doc['id'] ?>" target="_blank" class="btn-primary-sm" style="padding:6px 12px; background:#6d8089;" title="Ver documento">
                     <i class="ti ti-eye"></i> Ver
                  </a>
                  <a href="<?= APP_URL ?>/documento/descargar?id=<?= $doc['id'] ?>&action=download" class="btn-primary-sm" style="padding:6px 12px;" title="Descargar">
                     <i class="ti ti-download"></i> Descargar
                  </a>
               </td>
            </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
      <?php endif; ?>
   </div>
</div>
