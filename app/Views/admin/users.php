<?php include PARTIALS_PATH . '/sidebar-admin.php'; ?>

<div class="main-content">
   <div class="page-header">
      <div>
         <h1><i class="ti ti-users"></i> Usuarios</h1>
         <p>Gestión de usuarios del sistema</p>
      </div>
      <button class="btn-primary-sm" onclick="document.getElementById('modal-create-user').classList.add('show')">
         <i class="ti ti-user-plus"></i> Nuevo usuario
      </button>
   </div>

   <?php if ($success === 'user_created'): ?><div class="alert-success"><i class="ti ti-circle-check"></i> Usuario creado exitosamente.</div><?php endif; ?>
   <?php if ($success === 'user_deleted'): ?><div class="alert-success"><i class="ti ti-circle-check"></i> Usuario eliminado correctamente.</div><?php endif; ?>
   <?php if ($error): ?><div class="alert-error"><i class="ti ti-alert-circle"></i> Ocurrió un error. Intentá nuevamente.</div><?php endif; ?>

   <div class="panel-card">
      <h3><i class="ti ti-list"></i> Lista de usuarios (<?= count($users) ?>)</h3>
      <?php if (empty($users)): ?>
      <div class="empty-state"><i class="ti ti-users-off"></i><p>No hay usuarios registrados aún.</p></div>
      <?php else: ?>
      <table>
         <thead>
            <tr>
               <th>#</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Registrado</th><th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
               <td><?= $user['id'] ?></td>
               <td><strong><?= htmlspecialchars($user['name']) ?></strong></td>
               <td><?= htmlspecialchars($user['email']) ?></td>
               <td><span class="badge badge-blue"><?= htmlspecialchars($user['role_label']) ?></span></td>
               <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
               <td>
                  <?php if ($user['id'] != $currentUser['id']): ?>
                  <form method="POST" action="<?= APP_URL ?>/admin/usuarios" style="display:inline;"
                     onsubmit="return confirm('¿Eliminar a <?= htmlspecialchars($user['name']) ?>?')">
                     <input type="hidden" name="action" value="delete_user">
                     <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                     <button type="submit" class="btn-danger-sm"><i class="ti ti-trash"></i></button>
                  </form>
                  <?php else: ?>
                  <span style="font-size:11px;color:#9ca3af;">Tú</span>
                  <?php endif; ?>
               </td>
            </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
      <?php endif; ?>
   </div>
</div>

<!-- Modal: Crear usuario -->
<div class="modal-overlay" id="modal-create-user" onclick="if(event.target===this)this.classList.remove('show')">
   <div class="modal-box">
      <h4><i class="ti ti-user-plus"></i> Crear nuevo usuario</h4>
      <form method="POST" action="<?= APP_URL ?>/admin/usuarios">
         <input type="hidden" name="action" value="create_user">
         <div class="form-row">
            <div class="form-group">
               <label>Nombre completo *</label>
               <input type="text" name="name" required placeholder="Juan Pérez">
            </div>
            <div class="form-group">
               <label>Email *</label>
               <input type="email" name="email" required placeholder="juan@empresa.com">
            </div>
         </div>
         <div class="form-row">
            <div class="form-group">
               <label>Contraseña *</label>
               <input type="password" name="password" required minlength="6">
            </div>
            <div class="form-group">
               <label>Rol *</label>
               <select name="role_id" required>
                  <?php foreach ($roles as $role): ?>
                  <option value="<?= $role['id'] ?>"><?= htmlspecialchars($role['label']) ?></option>
                  <?php endforeach; ?>
               </select>
            </div>
         </div>
         <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn-primary-sm"><i class="ti ti-check"></i> Crear usuario</button>
            <button type="button" class="btn-primary-sm" style="background:#6b7280;"
               onclick="document.getElementById('modal-create-user').classList.remove('show')">Cancelar</button>
         </div>
      </form>
   </div>
</div>
