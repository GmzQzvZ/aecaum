<?php include PARTIALS_PATH . '/sidebar-admin.php'; ?>

<div class="main-content">
   <div class="page-header">
      <div>
         <h1><i class="ti ti-layout-grid"></i> Informes</h1>
         <p>Gestión de informes institucionales</p>
      </div>
      <button class="btn-primary-sm" onclick="document.getElementById('modal-create-informe').classList.add('show')">
         <i class="ti ti-plus"></i> Nuevo informe
      </button>
   </div>

   <?php if ($success === 'informe_created'): ?>
   <div class="alert-success"><i class="ti ti-circle-check"></i> Informe creado exitosamente.</div>
   <?php endif; ?>
   <?php if ($success === 'informe_deleted'): ?>
   <div class="alert-success"><i class="ti ti-circle-check"></i> Informe eliminado correctamente.</div>
   <?php endif; ?>
   <?php if ($error): ?>
   <div class="alert-error"><i class="ti ti-alert-circle"></i> Ocurrió un error. Intentá nuevamente.</div>
   <?php endif; ?>

   <div class="panel-card">
      <h3><i class="ti ti-list"></i> Lista de informes (<?= count($informes) ?>)</h3>
      <?php if (empty($informes)): ?>
         <div class="empty-state"><i class="ti ti-layout-grid-off"></i><p>No hay informes registrados aún.</p></div>
      <?php else: ?>
         <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
            <?php foreach ($informes as $inf): ?>
            <div class="card-informe" style="border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; background:#fff;">
               <div style="height:200px; overflow:hidden; background:#f5f6f7;">
                  <?php if (!empty($inf['image'])): ?>
                  <img src="<?= APP_URL ?>/<?= htmlspecialchars($inf['image']) ?>" alt="<?= htmlspecialchars($inf['title']) ?>" style="width:100%; height:100%; object-fit:cover;">
                  <?php endif; ?>
               </div>
               <div style="padding:15px;">
                  <h4 style="margin:0 0 10px 0; color:#0a3a78;"><?= htmlspecialchars($inf['title']) ?></h4>
                  <p style="color:#6d8089; font-size:14px; margin:0 0 15px 0; line-height:1.5;">Año: <?= htmlspecialchars($inf['year']) ?></p>
                  <?php if (!empty($inf['file_path'])): ?>
                  <a href="<?= APP_URL . '/' . htmlspecialchars($inf['file_path']) ?>" class="btn-primary-sm" target="_blank" rel="nofollow" style="display:inline-block;">Descargar</a>
                  <?php endif; ?>
                  <form method="POST" action="<?= APP_URL ?>/admin/informes" style="display:inline; margin-left:8px;" onsubmit="return confirm('¿Eliminar informe <?= htmlspecialchars($inf['title']) ?>?')">
                     <input type="hidden" name="action" value="delete_informe">
                     <input type="hidden" name="informe_id" value="<?= $inf['id'] ?>">
                     <button type="submit" class="btn-danger-sm"><i class="ti ti-trash"></i> Eliminar</button>
                  </form>
               </div>
            </div>
            <?php endforeach; ?>
         </div>
      <?php endif; ?>
   </div>

   <!-- Modal: Crear informe -->
   <div class="modal-overlay" id="modal-create-informe" onclick="if(event.target===this)this.classList.remove('show')">
      <div class="modal-box">
         <h4><i class="ti ti-plus"></i> Crear nuevo informe</h4>
         <form method="POST" action="<?= APP_URL ?>/admin/informes" enctype="multipart/form-data">
            <input type="hidden" name="action" value="create_informe">
            <div class="form-group">
               <label>Título *</label>
               <input type="text" name="title" required placeholder="Título del informe">
            </div>
            <div class="form-group">
                <label>Año *</label>
                <select name="year" required>
                <?php for ($y = 2000; $y <= date('Y'); $y++): ?>
                   <option value="<?= $y ?>"><?= $y ?></option>
                <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
               <label>Imagen (portada) *</label>
               <input type="file" name="image" required accept="image/*">
            </div>
            <div class="form-group">
                <label>Archivo del informe (PDF)</label>
                <input type="file" name="file" required accept="application/pdf">
            </div>
            <div style="display:flex; gap:12px; margin-top:8px;">
               <button type="submit" class="btn-primary-sm"><i class="ti ti-check"></i> Crear informe</button>
               <button type="button" class="btn-primary-sm" style="background:#6b7280;" onclick="document.getElementById('modal-create-informe').classList.remove('show')">Cancelar</button>
            </div>
         </form>
      </div>
   </div>

</div>
