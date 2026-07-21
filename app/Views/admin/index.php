<?php include PARTIALS_PATH . '/sidebar-admin.php'; ?>

<div class="main-content">
   <div class="page-header">
      <div>
         <h1><i class="ti ti-dashboard"></i> Dashboard Admin</h1>
         <p>Resumen general del sistema AECAUM</p>
      </div>
      <a href="<?= APP_URL ?>/admin/documentos" class="btn-primary-sm">
         <i class="ti ti-upload"></i> Subir documento
      </a>
   </div>

   <!-- Stats -->
   <div class="stats-grid">
      <div class="stat-card">
         <div class="stat-number"><?= $stats['users'] ?></div>
         <div class="stat-label"><i class="ti ti-users"></i> Usuarios registrados</div>
      </div>
      <div class="stat-card" style="border-top-color:#10b981;">
         <div class="stat-number" style="color:#065f46;"><?= $stats['roles'] ?></div>
         <div class="stat-label"><i class="ti ti-shield"></i> Roles del sistema</div>
      </div>
      <div class="stat-card" style="border-top-color:#f59e0b;">
         <div class="stat-number" style="color:#b45309;"><?= $stats['documents'] ?></div>
         <div class="stat-label"><i class="ti ti-files"></i> Documentos cargados</div>
      </div>
   </div>

   <!-- Quick actions -->
   <div class="panel-card">
      <h3><i class="ti ti-zap"></i> Acciones rápidas</h3>
      <div style="display:flex;gap:12px;flex-wrap:wrap;">
         <a href="<?= APP_URL ?>/admin/usuarios" class="btn-primary-sm"><i class="ti ti-user-plus"></i> Agregar usuario</a>
         <a href="<?= APP_URL ?>/admin/roles" class="btn-primary-sm" style="background:#10b981;"><i class="ti ti-shield-plus"></i> Agregar rol</a>
         <a href="<?= APP_URL ?>/admin/documentos" class="btn-primary-sm" style="background:#f59e0b;"><i class="ti ti-file-upload"></i> Subir documento</a>
         <a href="<?= APP_URL ?>/" class="btn-primary-sm" style="background:#6b7280;"><i class="ti ti-external-link"></i> Ver sitio</a>
      </div>
   </div>
</div>
