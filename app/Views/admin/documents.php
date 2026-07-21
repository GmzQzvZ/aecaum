<?php include PARTIALS_PATH . '/sidebar-admin.php'; ?>

<div class="main-content">
   <div class="page-header">
      <div>
         <h1><i class="ti ti-files"></i> Documentos</h1>
         <p>Gestión y permisos de documentos</p>
      </div>
      <button class="btn-primary-sm" onclick="document.getElementById('modal-upload').classList.add('show')">
         <i class="ti ti-upload"></i> Subir documento
      </button>
   </div>

   <?php if ($success === 'document_uploaded'): ?><div class="alert-success"><i class="ti ti-circle-check"></i> Documento subido correctamente.</div><?php endif; ?>
   <?php if ($success === 'document_deleted'): ?><div class="alert-success"><i class="ti ti-circle-check"></i> Documento eliminado.</div><?php endif; ?>
   <?php if ($error === 'upload_failed'): ?><div class="alert-error"><i class="ti ti-alert-circle"></i> Error al subir el archivo. Verificá el archivo e intentá nuevamente.</div><?php endif; ?>

   <div class="panel-card">
      <h3><i class="ti ti-files"></i> Documentos cargados (<?= count($documents) ?>)</h3>
      <?php if (empty($documents)): ?>
      <div class="empty-state"><i class="ti ti-file-off"></i><p>No hay documentos cargados aún.</p></div>
      <?php else: ?>
      <table>
         <thead>
            <tr><th>Título</th><th>Archivo</th><th>Subido por</th><th>Fecha</th><th>Acciones</th></tr>
         </thead>
         <tbody>
            <?php foreach ($documents as $doc): ?>
            <tr>
               <td><strong><?= htmlspecialchars($doc['title']) ?></strong>
                  <?php if ($doc['description']): ?>
                  <br><small style="color:#9ca3af;"><?= htmlspecialchars($doc['description']) ?></small>
                  <?php endif; ?>
               </td>
               <td><i class="ti ti-file"></i> <?= htmlspecialchars($doc['filename']) ?></td>
               <td><?= htmlspecialchars($doc['uploader_name'] ?? '—') ?></td>
               <td><?= date('d/m/Y', strtotime($doc['created_at'])) ?></td>
               <td style="display:flex;gap:6px;">
                  <a href="<?= APP_URL ?>/<?= htmlspecialchars($doc['path']) ?>" class="btn-primary-sm" download style="padding:6px 12px;">
                     <i class="ti ti-download"></i>
                  </a>
                  <form method="POST" action="<?= APP_URL ?>/admin/documentos" onsubmit="return confirm('¿Eliminar este documento?')">
                     <input type="hidden" name="action" value="delete_document">
                     <input type="hidden" name="document_id" value="<?= $doc['id'] ?>">
                     <button type="submit" class="btn-danger-sm"><i class="ti ti-trash"></i></button>
                  </form>
               </td>
            </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
      <?php endif; ?>
   </div>
</div>

<!-- Modal: Subir documento -->
<div class="modal-overlay" id="modal-upload" onclick="if(event.target===this)this.classList.remove('show')">
   <div class="modal-box">
      <h4><i class="ti ti-file-upload"></i> Subir nuevo documento</h4>
      <form method="POST" action="<?= APP_URL ?>/admin/documentos" enctype="multipart/form-data">
         <input type="hidden" name="action" value="upload_document">
         <div class="form-group">
            <label>Título del documento *</label>
            <input type="text" name="title" required placeholder="Ej: Convenio Colectivo 2025">
         </div>
         <div class="form-group">
            <label>Descripción</label>
            <input type="text" name="description" placeholder="Breve descripción del documento">
         </div>
         <div class="form-group">
            <label>Archivo *</label>
            <input type="file" name="document" required accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg">
         </div>
         <div class="form-group">
            <label>Roles con acceso *</label>
            <div style="display:flex;flex-direction:column;gap:8px;padding:12px;background:#f9fafb;border-radius:8px;border:1px solid #e5e7eb;">
               <?php foreach ($roles as $role): ?>
               <label style="display:flex;align-items:center;gap:8px;font-weight:400;cursor:pointer;">
                  <input type="checkbox" name="allowed_roles[]" value="<?= $role['id'] ?>" checked>
                  <?= htmlspecialchars($role['label']) ?>
               </label>
               <?php endforeach; ?>
            </div>
         </div>
         <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn-primary-sm"><i class="ti ti-upload"></i> Subir documento</button>
            <button type="button" class="btn-primary-sm" style="background:#6b7280;"
               onclick="document.getElementById('modal-upload').classList.remove('show')">Cancelar</button>
         </div>
      </form>
   </div>
</div>
