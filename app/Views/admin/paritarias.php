<?php include PARTIALS_PATH . '/sidebar-admin.php'; ?>

<div class="main-content">
   <div class="page-header">
      <div>
         <h1><i class="ti ti-file-certificate"></i> Paritarias</h1>
         <p>Gestión de planillas salariales y acuerdos paritarios por año</p>
      </div>
   </div>

   <?php if ($success === 'paritaria_created'): ?><div class="alert-success"><i class="ti ti-circle-check"></i> Documento cargado correctamente.</div><?php endif; ?>
   <?php if ($success === 'paritaria_deleted'): ?><div class="alert-success"><i class="ti ti-circle-check"></i> Documento eliminado correctamente.</div><?php endif; ?>
   <?php if ($error === 'invalid_data'): ?><div class="alert-error"><i class="ti ti-alert-circle"></i> Revisá el título, el año y el tipo de documento.</div><?php elseif ($error === 'homologacion_required'): ?><div class="alert-error"><i class="ti ti-alert-circle"></i> Para cargar un acuerdo paritario, también tenés que adjuntar el PDF de homologación.</div><?php elseif ($error === 'upload_too_large'): ?><div class="alert-error"><i class="ti ti-alert-circle"></i> El tamaño total de los PDF supera el límite permitido para la carga.</div><?php elseif ($error === 'invalid_file'): ?><div class="alert-error"><i class="ti ti-alert-circle"></i> Todos los archivos deben ser PDF válidos.</div><?php elseif ($error === 'upload_failed'): ?><div class="alert-error"><i class="ti ti-alert-circle"></i> No se pudo cargar el archivo. Verificá los PDF y los permisos de carga.</div><?php elseif ($error === 'save_failed'): ?><div class="alert-error"><i class="ti ti-alert-circle"></i> Los archivos se cargaron, pero no se pudo guardar el registro. Revisá que la tabla paritarias esté actualizada.</div><?php elseif ($error === 'delete_failed'): ?><div class="alert-error"><i class="ti ti-alert-circle"></i> No se pudo eliminar el documento.</div><?php endif; ?>

   <div class="panel-card">
      <h3><i class="ti ti-upload"></i> Cargar documento</h3>
      <form method="POST" action="<?= APP_URL ?>/admin/paritarias" enctype="multipart/form-data">
         <input type="hidden" name="action" value="create_paritaria">
         <div class="form-group">
            <label for="paritaria-title">Título *</label>
            <input id="paritaria-title" type="text" name="title" maxlength="255" required placeholder="Título del documento">
         </div>
         <div class="form-row">
            <div class="form-group">
               <label for="paritaria-year">Año *</label>
               <input id="paritaria-year" type="number" name="year" min="1900" max="9999" value="<?= date('Y') ?>" required>
            </div>
            <div class="form-group">
               <label for="paritaria-category">Tipo de documento *</label>
               <select id="paritaria-category" name="category" required>
                  <option value="planillas_salariales">Planillas salariales</option>
                  <option value="acuerdos_paritarios">Acuerdos paritarios</option>
               </select>
            </div>
         </div>
         <div class="form-group">
            <label for="paritaria-document">Documento (PDF) *</label>
            <input id="paritaria-document" type="file" name="document" required accept="application/pdf,.pdf">
         </div>
         <div class="form-group" id="paritaria-homologacion-field" hidden>
            <label for="paritaria-homologacion">Homologación (PDF) *</label>
            <input id="paritaria-homologacion" type="file" name="homologacion" accept="application/pdf,.pdf">
         </div>
         <button type="submit" class="btn-primary-sm"><i class="ti ti-upload"></i> Cargar documento</button>
      </form>
   </div>

   <div class="panel-card">
      <h3><i class="ti ti-list"></i> Documentos cargados (<?= count($documents) ?>)</h3>
      <?php if (empty($documents)): ?>
         <div class="empty-state"><i class="ti ti-file-off"></i><p>No hay documentos de paritarias cargados aún.</p></div>
      <?php else: ?>
         <div style="overflow-x:auto;">
            <table class="paritarias-admin-table">
               <thead><tr><th>Año</th><th>Título</th><th>Tipo</th><th>Archivo</th><th>Acciones</th></tr></thead>
               <tbody>
                  <?php foreach ($documents as $document): ?>
                     <tr>
                        <td><?= (int) $document['year'] ?></td>
                        <td><?= htmlspecialchars($document['title'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= $document['category'] === 'planillas_salariales' ? 'Planillas salariales' : 'Acuerdos paritarios' ?></td>
                        <td>
                           <a href="<?= APP_URL ?>/<?= htmlspecialchars($document['document_path'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">Ver PDF</a>
                           <?php if (!empty($document['homologacion_path'])): ?><br><a href="<?= APP_URL ?>/<?= htmlspecialchars($document['homologacion_path'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">Ver homologación</a><?php endif; ?>
                        </td>
                        <td>
                           <form method="POST" action="<?= APP_URL ?>/admin/paritarias" onsubmit="return confirm('¿Eliminar este documento?')">
                              <input type="hidden" name="action" value="delete_paritaria">
                              <input type="hidden" name="paritaria_id" value="<?= (int) $document['id'] ?>">
                              <button type="submit" class="btn-danger-sm"><i class="ti ti-trash"></i> Eliminar</button>
                           </form>
                        </td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      <?php endif; ?>
   </div>
</div>

<style>
.paritarias-admin-table{width:100%;border-collapse:collapse;color:#334155;font-size:14px}.paritarias-admin-table th,.paritarias-admin-table td{padding:12px 14px;border-bottom:1px solid #e5e7eb;text-align:left;vertical-align:middle}.paritarias-admin-table th{background:#f8fafc;color:#0b477d;font-weight:700}.paritarias-admin-table a{color:#0878a9;text-decoration:none}.paritarias-admin-table a:hover{text-decoration:underline}.paritarias-admin-table form{margin:0}#paritaria-homologacion-field[hidden]{display:none}@media(max-width:600px){.paritarias-admin-table{font-size:12px}.paritarias-admin-table th,.paritarias-admin-table td{padding:9px 10px}}
</style>

<script>
const paritariaCategory = document.getElementById('paritaria-category');
const homologacionField = document.getElementById('paritaria-homologacion-field');
const homologacionInput = document.getElementById('paritaria-homologacion');
function updateHomologacionRequirement() {
   const isAgreement = paritariaCategory.value === 'acuerdos_paritarios';
   homologacionField.hidden = !isAgreement;
   homologacionInput.required = isAgreement;
}
paritariaCategory.addEventListener('change', updateHomologacionRequirement);
updateHomologacionRequirement();
</script>
