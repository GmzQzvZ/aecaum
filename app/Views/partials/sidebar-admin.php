<?php
// Determinar qué sección está activa
$currentSection = 'dashboard';
$uri = trim(substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH)), '/');
if (str_starts_with($uri, 'admin/usuarios')) $currentSection = 'users';
elseif (str_starts_with($uri, 'admin/roles'))    $currentSection = 'roles';
elseif (str_starts_with($uri, 'admin/documentos')) $currentSection = 'documents';
elseif (str_starts_with($uri, 'admin/indices'))   $currentSection = 'indices';
elseif (str_starts_with($uri, 'admin'))           $currentSection = 'admin';
elseif (str_starts_with($uri, 'dashboard'))       $currentSection = 'dashboard';
?>
<!-- Sidebar Admin -->
<div class="sidebar">
   <div class="sidebar-brand">
      <img src="<?= ASSETS_URL ?>/img/logo/aecaum.png" alt="AECAUM" onerror="this.style.display='none'">
      <div class="sidebar-brand-text">
         <h2>AECAUM</h2>
         <span>Panel de Administración</span>
      </div>
   </div>

   <?php if (!empty($currentUser)): ?>
   <div class="user-info">
      <h4><?= htmlspecialchars($currentUser['name']) ?></h4>
      <p><?= htmlspecialchars($currentUser['email']) ?></p>
      <span class="user-role"><?= htmlspecialchars($currentUser['role_label']) ?></span>
   </div>
   <?php endif; ?>

   <nav class="sidebar-nav">
      <div class="nav-group-label">Principal</div>
      <a href="<?= APP_URL ?>/admin" class="<?= $currentSection === 'admin' ? 'active' : '' ?>">
         <i class="ti ti-dashboard"></i> Dashboard
      </a>

      <div class="nav-group-label">Gestión</div>
      <a href="<?= APP_URL ?>/admin/usuarios" class="<?= $currentSection === 'users' ? 'active' : '' ?>">
         <i class="ti ti-users"></i> Usuarios
      </a>
      <a href="<?= APP_URL ?>/admin/roles" class="<?= $currentSection === 'roles' ? 'active' : '' ?>">
         <i class="ti ti-shield"></i> Roles
      </a>
      <a href="<?= APP_URL ?>/admin/documentos" class="<?= $currentSection === 'documents' ? 'active' : '' ?>">
         <i class="ti ti-files"></i> Documentos
      </a>
      <a href="<?= APP_URL ?>/admin/indices" class="<?= $currentSection === 'indices' ? 'active' : '' ?>">
         <i class="ti ti-layout-grid"></i> Índices
      </a>
   </nav>

   <div class="sidebar-footer">
      <a href="<?= APP_URL ?>/"><i class="ti ti-home"></i> Ver sitio web</a>
      <a href="<?= APP_URL ?>/logout" style="margin-top:4px;"><i class="ti ti-logout"></i> Cerrar sesión</a>
   </div>
</div>
