<?php include PARTIALS_PATH . '/sidebar-admin.php'; ?>

<div class="main-content">
   <div class="page-header">
      <div>
         <h1><i class="ti ti-shield"></i> Roles</h1>
         <p>Gestión de roles y permisos del sistema</p>
      </div>
      <button class="btn-primary-sm" onclick="document.getElementById('modal-create-role').classList.add('show')">
         <i class="ti ti-shield-plus"></i> Nuevo rol
      </button>
   </div>

   <?php if ($success === 'role_created'): ?><div class="alert-success"><i class="ti ti-circle-check"></i> Rol creado exitosamente.</div><?php endif; ?>
   <?php if ($success === 'role_deleted'): ?><div class="alert-success"><i class="ti ti-circle-check"></i> Rol eliminado.</div><?php endif; ?>

   <div class="panel-card">
      <h3><i class="ti ti-list"></i> Roles del sistema (<?= count($roles) ?>)</h3>
      <?php if (empty($roles)): ?>
      <div class="empty-state"><i class="ti ti-shield-off"></i><p>No hay roles configurados.</p></div>
      <?php else: ?>
      <table>
         <thead><tr><th>#</th><th>Nombre (slug)</th><th>Etiqueta</th><th>Descripción</th><th>Creado</th><th>Acciones</th></tr></thead>
         <tbody>
            <?php foreach ($roles as $role): ?>
            <tr>
               <td><?= $role['id'] ?></td>
               <td><code style="background:#f3f4f6;padding:2px 8px;border-radius:4px;font-size:12px;"><?= htmlspecialchars($role['name']) ?></code></td>
               <td><strong><?= htmlspecialchars($role['label']) ?></strong></td>
               <td style="color:#6b7280;"><?= htmlspecialchars($role['description'] ?? '—') ?></td>
               <td><?= date('d/m/Y', strtotime($role['created_at'])) ?></td>
               <td>
                  <form method="POST" action="<?= APP_URL ?>/admin/roles" style="display:inline;"
                     onsubmit="return confirm('¿Eliminar el rol <?= htmlspecialchars($role['label']) ?>? Esto puede afectar a usuarios asignados.')">
                     <input type="hidden" name="action" value="delete_role">
                     <input type="hidden" name="role_id" value="<?= $role['id'] ?>">
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

<!-- Modal: Crear rol -->
<div class="modal-overlay" id="modal-create-role" onclick="if(event.target===this)this.classList.remove('show')">
   <div class="modal-box">
      <h4><i class="ti ti-shield-plus"></i> Crear nuevo rol</h4>
      <form method="POST" action="<?= APP_URL ?>/admin/roles">
         <input type="hidden" name="action" value="create_role">
         <div class="form-group">
            <label>Nombre interno (slug) *</label>
            <input type="text" name="name" required placeholder="ej: socio_activo" pattern="[a-zA-Z0-9_\-]+"
               title="Solo letras, números, guiones y guión bajo">
            <small style="color:#9ca3af;font-size:11px;">Sin espacios ni caracteres especiales</small>
         </div>
         <div class="form-group">
            <label>Etiqueta visible *</label>
            <input type="text" name="label" required placeholder="ej: Socio Activo">
         </div>
         <div class="form-group">
            <label>Descripción</label>
            <input type="text" name="description" placeholder="Permisos y alcance del rol">
         </div>
         <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn-primary-sm"><i class="ti ti-check"></i> Crear rol</button>
            <button type="button" class="btn-primary-sm" style="background:#6b7280;"
               onclick="document.getElementById('modal-create-role').classList.remove('show')">Cancelar</button>
         </div>
      </form>
   </div>
</div>
