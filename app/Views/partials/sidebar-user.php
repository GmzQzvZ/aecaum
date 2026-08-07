<!-- Sidebar Usuario -->
<div class="sidebar">
   <div class="sidebar-brand">
      <img loading="lazy" src="<?= ASSETS_URL ?>/img/logo/logo.png" alt="AECAUM" onerror="this.style.display='none'">
      <div class="sidebar-brand-text">
         <h2>AECAUM</h2>
         <span>Mi Panel</span>
      </div>
      <button class="toggle-btn"><i class="ti ti-menu-2"></i></button>
   </div>

   <?php if (!empty($currentUser)): ?>
   <div class="user-info">
      <h4><?= htmlspecialchars($currentUser['name']) ?></h4>
      <p><?= htmlspecialchars($currentUser['email']) ?></p>
      <span class="user-role"><?= htmlspecialchars($currentUser['role_label']) ?></span>
   </div>
   <?php endif; ?>

   <nav class="sidebar-nav">
      <div class="nav-group-label">Mi espacio</div>
      <a href="<?= APP_URL ?>/dashboard" class="<?= strpos($_SERVER['REQUEST_URI'], '/dashboard') !== false && strpos($_SERVER['REQUEST_URI'], '/indices') === false && strpos($_SERVER['REQUEST_URI'], '/informes-institucionales') === false ? 'active' : '' ?>">
         <i class="ti ti-dashboard"></i> Dashboard
      </a>
      <a href="<?= APP_URL ?>/dashboard/indices" class="<?= strpos($_SERVER['REQUEST_URI'], '/dashboard/indices') !== false ? 'active' : '' ?>">
         <i class="ti ti-layout-grid"></i> Índices
      </a>
      <a href="<?= APP_URL ?>/dashboard/informes-institucionales" class="<?= strpos($_SERVER['REQUEST_URI'], '/dashboard/informes-institucionales') !== false ? 'active' : '' ?>">
         <i class="ti ti-file-description"></i> Informes Inst.
      </a>
   </nav>

   <div class="sidebar-footer">
      <a href="<?= APP_URL ?>/"><i class="ti ti-home"></i> <span>Ver sitio web</span></a>
      <a href="<?= APP_URL ?>/logout" style="margin-top:4px;"><i class="ti ti-logout"></i> <span>Cerrar sesión</span></a>
   </div>
</div>
