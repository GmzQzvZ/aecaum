<?php include PARTIALS_PATH . '/sidebar-admin.php'; ?>

<div class="main-content">
   <div class="page-header">
      <div>
         <h1><i class="ti ti-mail"></i> Mensajes de Contacto</h1>
         <p>Consultas recibidas desde el formulario de contacto</p>
      </div>
   </div>

   <?php if ($success === 'message_deleted'): ?><div class="alert-success"><i class="ti ti-circle-check"></i> Mensaje eliminado correctamente.</div><?php endif; ?>
   <?php if ($error): ?><div class="alert-error"><i class="ti ti-alert-circle"></i> Ocurrió un error. Intentá nuevamente.</div><?php endif; ?>

   <div class="panel-card">
      <h3><i class="ti ti-list"></i> Lista de mensajes (<?= count($messages) ?>)</h3>
      <?php if (empty($messages)): ?>
      <div class="empty-state"><i class="ti ti-mail-off"></i><p>No hay mensajes de contacto aún.</p></div>
      <?php else: ?>
      <table>
         <thead>
            <tr>
               <th>#</th><th>Nombre</th><th>Email</th><th>Mensaje</th><th>Fecha</th><th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($messages as $msg): ?>
            <tr>
               <td><?= $msg['id'] ?></td>
               <td><strong><?= htmlspecialchars($msg['name']) ?></strong></td>
               <td><?= htmlspecialchars($msg['email']) ?></td>
               <td><div style="max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= htmlspecialchars($msg['message']) ?></div></td>
               <td><?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?></td>
               <td>
                  <button class="btn-primary-sm" onclick="viewMessage(<?= $msg['id'] ?>, '<?= htmlspecialchars($msg['name'], ENT_QUOTES) ?>', '<?= htmlspecialchars($msg['email'], ENT_QUOTES) ?>', '<?= htmlspecialchars($msg['message'], ENT_QUOTES) ?>')" title="Ver mensaje">
                     <i class="ti ti-eye"></i>
                  </button>
                  <form method="POST" action="<?= APP_URL ?>/admin/contacto" style="display:inline;"
                     onsubmit="return confirm('¿Eliminar este mensaje?')">
                     <input type="hidden" name="action" value="delete_message">
                     <input type="hidden" name="message_id" value="<?= $msg['id'] ?>">
                     <button type="submit" class="btn-danger-sm" title="Eliminar"><i class="ti ti-trash"></i></button>
                  </form>
               </td>
            </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
      <?php endif; ?>
   </div>
</div>

<!-- Modal: Ver mensaje -->
<div class="modal-overlay" id="modal-view-message" onclick="if(event.target===this)this.classList.remove('show')">
   <div class="modal-box">
      <h4><i class="ti ti-mail"></i> Mensaje de contacto</h4>
      <div class="form-group">
         <label>Nombre:</label>
         <div id="view_name" style="font-weight:600;margin-bottom:12px;"></div>
      </div>
      <div class="form-group">
         <label>Email:</label>
         <div id="view_email" style="margin-bottom:12px;"></div>
      </div>
      <div class="form-group">
         <label>Mensaje:</label>
         <div id="view_message" style="background:#f9fafb;padding:12px;border-radius:6px;min-height:100px;white-space:pre-wrap;"></div>
      </div>
      <button type="button" class="btn-primary-sm" style="background:#6b7280;margin-top:12px;"
         onclick="document.getElementById('modal-view-message').classList.remove('show')">Cerrar</button>
   </div>
</div>

<script>
function viewMessage(id, name, email, message) {
   document.getElementById('view_name').textContent = name;
   document.getElementById('view_email').textContent = email;
   document.getElementById('view_message').textContent = message;
   document.getElementById('modal-view-message').classList.add('show');
}
</script>
