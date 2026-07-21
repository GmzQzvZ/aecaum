<!-- Sidebar Usuario -->
<div class="sidebar">
   <div class="sidebar-brand">
      <img src="<?= ASSETS_URL ?>/img/logo/logo.png" alt="AECAUM" onerror="this.style.display='none'">
      <div class="sidebar-brand-text">
         <h2>AECAUM</h2>
         <span>Mi Panel</span>
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
      <div class="nav-group-label">Mi espacio</div>
      <a href="<?= APP_URL ?>/dashboard" class="active">
         <i class="ti ti-dashboard"></i> Dashboard
      </a>
      <a href="<?= APP_URL ?>/dashboard">
         <i class="ti ti-files"></i> Mis documentos
      </a>
   </nav>

   <div class="sidebar-footer">
      <a href="<?= APP_URL ?>/"><i class="ti ti-home"></i> Ver sitio web</a>
      <a href="<?= APP_URL ?>/logout" style="margin-top:4px;"><i class="ti ti-logout"></i> Cerrar sesión</a>
   </div>
</div>
