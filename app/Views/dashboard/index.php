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
      <?php if ($currentUser['role_label'] !== 'Socio'): ?>
      <div class="stat-card" style="border-top-color:#10b981;">
         <div class="stat-number" style="color:#065f46;"><?= $stats['uploaded'] ?></div>
         <div class="stat-label"><i class="ti ti-upload"></i> Documentos subidos por mí</div>
      </div>
      <?php endif; ?>
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
               <td>
                  <a href="<?= APP_URL ?>/<?= htmlspecialchars($doc['path']) ?>" class="btn-primary-sm" download style="padding:6px 12px;">
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
