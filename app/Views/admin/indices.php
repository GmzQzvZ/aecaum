<?php include PARTIALS_PATH . '/sidebar-admin.php'; ?>

<div class="main-content">
   <div class="page-header">
      <div>
         <h1><i class="ti ti-layout-grid"></i> Índices</h1>
         <p>Gestión de índices del sistema</p>
      </div>
      <button class="btn-primary-sm" onclick="document.getElementById('modal-create-index').classList.add('show')">
         <i class="ti ti-plus"></i> Nuevo índice
      </button>
   </div>

   <?php if ($success === 'index_created'): ?>
      <div class="alert-success"><i class="ti ti-circle-check"></i> Índice creado exitosamente.</div><?php endif; ?>
   <?php if ($success === 'index_updated'): ?>
      <div class="alert-success"><i class="ti ti-circle-check"></i> Índice mensual actualizado.</div><?php endif; ?>
   <?php if ($success === 'index_deleted'): ?>
      <div class="alert-success"><i class="ti ti-circle-check"></i> Índice eliminado correctamente.</div><?php endif; ?>
   <?php if ($error): ?>
      <div class="alert-error"><i class="ti ti-alert-circle"></i> Ocurrió un error. Intentá nuevamente.</div>
   <?php endif; ?>

   <div class="panel-card">
      <h3><i class="ti ti-list"></i> Lista de índices (<?= count($indices) ?>)</h3>
      <?php if (empty($indices)): ?>
         <div class="empty-state"><i class="ti ti-layout-grid-off"></i>
            <p>No hay índices registrados aún.</p>
         </div>
      <?php else: ?>
         <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            <?php foreach ($indices as $index): ?>
               <div style="border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; background: #fff;">
                  <div style="height: 200px; overflow: hidden; background: #f5f6f7;">
                     <img loading="lazy" src="<?= APP_URL ?>/<?= htmlspecialchars($index['image']) ?>"
                        alt="<?= htmlspecialchars($index['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
                  <div style="padding: 15px;">
                     <h4 style="margin: 0 0 10px 0; color: #0a3a78;"><?= htmlspecialchars($index['title']) ?></h4>

                     <button type="button" class="btn-primary-sm" data-edit-index
                        data-id="<?= (int) $index['id'] ?>"
                        data-title="<?= htmlspecialchars($index['title'], ENT_QUOTES, 'UTF-8') ?>"
                        data-month="<?= htmlspecialchars($index['month'], ENT_QUOTES, 'UTF-8') ?>"
                        data-year="<?= (int) $index['year'] ?>">
                        <i class="ti ti-edit"></i> Editar índice mensual
                     </button>

                     <form method="POST" action="<?= APP_URL ?>/admin/indices" style="display:inline;"
                        onsubmit="return confirm('¿Eliminar índice <?= htmlspecialchars($index['title']) ?>?')">
                        <input type="hidden" name="action" value="delete_index">
                        <input type="hidden" name="index_id" value="<?= $index['id'] ?>">
                        <button type="submit" class="btn-danger-sm"><i class="ti ti-trash"></i> Eliminar</button>
                     </form>
                  </div>
               </div>
            <?php endforeach; ?>
         </div>
      <?php endif; ?>
   </div>
</div>

<div class="modal-overlay" id="modal-edit-index" onclick="if(event.target===this)this.classList.remove('show')">
   <div class="modal-box">
      <h4><i class="ti ti-edit"></i> Editar índice mensual</h4>
      <form method="POST" action="<?= APP_URL ?>/admin/indices" enctype="multipart/form-data">
         <input type="hidden" name="action" value="update_index"><input type="hidden" name="index_id" id="edit-index-id">
         <div class="form-group"><label>Título *</label><input type="text" name="title" id="edit-index-title" required maxlength="255"></div>
         <div class="form-row">
            <div class="form-group"><label>Mes *</label><select name="month" id="edit-index-month" required>
               <?php foreach (['enero'=>'Enero','febrero'=>'Febrero','marzo'=>'Marzo','abril'=>'Abril','mayo'=>'Mayo','junio'=>'Junio','julio'=>'Julio','agosto'=>'Agosto','septiembre'=>'Septiembre','octubre'=>'Octubre','noviembre'=>'Noviembre','diciembre'=>'Diciembre'] as $value => $label): ?><option value="<?= $value ?>"><?= $label ?></option><?php endforeach; ?>
            </select></div>
            <div class="form-group"><label>Año *</label><input type="number" name="year" id="edit-index-year" min="2000" max="2100" required></div>
         </div>
         <p style="color:#64748b;font-size:13px;">Dejá vacío un archivo para conservar el actual.</p>
         <div class="form-group"><label>Imagen Servicio Última Milla</label><input type="file" name="image" accept="image/jpeg,image/png,image/webp"></div>
         <div class="form-row"><div class="form-group"><label>Imagen Servicios Postales</label><input type="file" name="image2" accept="image/jpeg,image/png,image/webp"></div><div class="form-group"><label>Imagen Porcentajes</label><input type="file" name="image3" accept="image/jpeg,image/png,image/webp"></div></div>
         <div class="form-group"><label>Informe Completo (PDF)</label><input type="file" name="informe" accept="application/pdf"></div>
         <div class="form-group"><label>Informe Mensual (PDF)</label><input type="file" name="informe_mensual" accept="application/pdf"></div>
         <div style="display:flex;gap:12px;margin-top:8px;"><button type="submit" class="btn-primary-sm"><i class="ti ti-device-floppy"></i> Guardar cambios</button><button type="button" class="btn-primary-sm" style="background:#6b7280;" onclick="document.getElementById('modal-edit-index').classList.remove('show')">Cancelar</button></div>
      </form>
   </div>
</div>
<script>
document.querySelectorAll('[data-edit-index]').forEach(function (button) {
   button.addEventListener('click', function () {
      document.getElementById('edit-index-id').value = button.dataset.id;
      document.getElementById('edit-index-title').value = button.dataset.title;
      document.getElementById('edit-index-month').value = button.dataset.month;
      document.getElementById('edit-index-year').value = button.dataset.year;
      document.getElementById('modal-edit-index').classList.add('show');
   });
});
</script>

<!-- Modal: Crear índice -->
<div class="modal-overlay" id="modal-create-index" onclick="if(event.target===this)this.classList.remove('show')">
   <div class="modal-box">
      <h4><i class="ti ti-plus"></i> Crear nuevo índice</h4>
      <form method="POST" action="<?= APP_URL ?>/admin/indices" enctype="multipart/form-data">
         <input type="hidden" name="action" value="create_index">
         <div class="form-group">
            <label>Título *</label>
            <input type="text" name="title" required placeholder="Título del índice">
         </div>
         <div class="form-row">
            <div class="form-group">
               <label>Mes *</label>
               <select name="month" required>
                  <option value="enero">Enero</option>
                  <option value="febrero">Febrero</option>
                  <option value="marzo">Marzo</option>
                  <option value="abril">Abril</option>
                  <option value="mayo">Mayo</option>
                  <option value="junio">Junio</option>
                  <option value="julio">Julio</option>
                  <option value="agosto">Agosto</option>
                  <option value="septiembre">Septiembre</option>
                  <option value="octubre">Octubre</option>
                  <option value="noviembre">Noviembre</option>
                  <option value="diciembre">Diciembre</option>
               </select>
            </div>
            <div class="form-group">
               <label>Año *</label>
               <select name="year" required>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                  <option value="2028">2028</option>
                  <option value="2029">2029</option>
                  <option value="2030">2030</option>
                  <option value="2031">2031</option>
                  <option value="2032">2032</option>
                  <option value="2033">2033</option>
                  <option value="2034">2034</option>
                  <option value="2035">2035</option>
               </select>
            </div>
         </div>
         <div class="form-group">
            <label>Imagen Servicio Última Milla *</label>
            <input type="file" name="image" required accept="image/*">
         </div>
         <div class="form-row">
            <div class="form-group">
               <label>Imagen Servicios Postales *</label>
               <input type="file" name="image2" required accept="image/*">
            </div>
            <div class="form-group">
               <label>Imagen Porcentajes *</label>
               <input type="file" name="image3" required accept="image/*">
            </div>
         </div>
         <div class="form-group">
            <label>Informe Completo (PDF) *</label>
            <input type="file" name="informe" required accept="application/pdf">
         </div>
         <div class="form-group">
            <label>Informe Mensual (PDF) *</label>
            <input type="file" name="informe_mensual" required accept="application/pdf">
         </div>
         <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn-primary-sm"><i class="ti ti-check"></i> Crear índice</button>
            <button type="button" class="btn-primary-sm" style="background:#6b7280;"
               onclick="document.getElementById('modal-create-index').classList.remove('show')">Cancelar</button>
         </div>
      </form>
   </div>
</div>
