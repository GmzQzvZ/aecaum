<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title><?= htmlspecialchars($pageTitle ?? APP_NAME) ?></title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="shortcut icon" type="image/x-icon" href="<?= ASSETS_URL ?>/img/favicon.ico">
   <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
   <?php if (!empty($extraHead)) echo $extraHead; ?>
   <style>
      * { margin: 0; padding: 0; box-sizing: border-box; }
      body { background: #f5f6fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
      .panel-layout { display: flex; min-height: 100vh; }
      .sidebar {
         width: 280px; background: linear-gradient(180deg, #1a3acc 0%, #0d2596 100%);
         color: white; padding: 0; position: fixed; height: 100vh; overflow-y: auto;
         display: flex; flex-direction: column; z-index: 100;
      }
      .sidebar-brand {
         padding: 24px 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.12);
         display: flex; align-items: center; gap: 12px;
      }
      .sidebar-brand img { width: 36px; }
      .sidebar-brand-text h2 { font-size: 16px; font-weight: 700; line-height: 1.2; }
      .sidebar-brand-text span { font-size: 11px; opacity: 0.65; }
      .user-info {
         margin: 16px; padding: 14px 16px; background: rgba(255,255,255,0.08);
         border-radius: 10px; border: 1px solid rgba(255,255,255,0.1);
      }
      .user-info h4 { font-size: 14px; font-weight: 600; margin-bottom: 2px; }
      .user-info p { font-size: 11px; opacity: 0.7; margin-bottom: 8px; word-break: break-all; }
      .user-role {
         display: inline-block; padding: 3px 10px;
         background: rgba(255,255,255,0.15); border-radius: 20px; font-size: 10px; font-weight: 600;
      }
      .sidebar-nav { flex: 1; padding: 8px 0; }
      .nav-group-label {
         font-size: 10px; font-weight: 700; letter-spacing: 1px; opacity: 0.45;
         text-transform: uppercase; padding: 16px 20px 6px;
      }
      .sidebar-nav a {
         display: flex; align-items: center; gap: 10px;
         padding: 10px 20px; color: rgba(255,255,255,0.75);
         text-decoration: none; transition: all 0.2s; font-size: 14px;
         border-left: 3px solid transparent;
      }
      .sidebar-nav a:hover, .sidebar-nav a.active {
         background: rgba(255,255,255,0.1); color: white; border-left-color: #60a5fa;
      }
      .sidebar-nav a i { font-size: 18px; min-width: 20px; }
      .sidebar-footer {
         padding: 16px; border-top: 1px solid rgba(255,255,255,0.1);
      }
      .sidebar-footer a {
         display: flex; align-items: center; gap: 8px;
         color: rgba(255,255,255,0.6); text-decoration: none; font-size: 13px;
         padding: 8px 12px; border-radius: 8px; transition: all 0.2s;
      }
      .sidebar-footer a:hover { background: rgba(255,255,255,0.08); color: white; }
      .main-content { flex: 1; margin-left: 280px; padding: 30px; min-height: 100vh; }
      .page-header {
         background: white; padding: 20px 28px; border-radius: 14px;
         margin-bottom: 28px; box-shadow: 0 1px 4px rgba(0,0,0,0.06);
         display: flex; justify-content: space-between; align-items: center;
      }
      .page-header h1 { font-size: 22px; font-weight: 700; color: #1a3acc; }
      .page-header p { color: #6b7280; font-size: 13px; margin-top: 2px; }
      .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px; margin-bottom: 28px; }
      .stat-card {
         background: white; padding: 22px 24px; border-radius: 14px;
         box-shadow: 0 1px 4px rgba(0,0,0,0.06); border-top: 3px solid #2B4DFF;
      }
      .stat-number { font-size: 32px; font-weight: 800; color: #1a3acc; }
      .stat-label { font-size: 13px; color: #6b7280; margin-top: 4px; }
      .panel-card {
         background: white; border-radius: 14px; box-shadow: 0 1px 4px rgba(0,0,0,0.06); padding: 24px; margin-bottom: 24px;
      }
      .panel-card h3 { font-size: 17px; font-weight: 700; color: #1a3acc; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
      .btn-primary-sm {
         background: #2B4DFF; color: white; border: none; padding: 8px 18px;
         border-radius: 8px; font-size: 13px; cursor: pointer; text-decoration: none;
         display: inline-flex; align-items: center; gap: 6px; transition: background 0.2s;
      }
      .btn-primary-sm:hover { background: #1a3acc; color: white; }
      .btn-danger-sm {
         background: #ef4444; color: white; border: none; padding: 6px 14px;
         border-radius: 6px; font-size: 12px; cursor: pointer;
      }
      .btn-danger-sm:hover { background: #dc2626; }
      .alert-success {
         background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;
         padding: 10px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;
      }
      .alert-error {
         background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5;
         padding: 10px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;
      }
      table { width: 100%; border-collapse: collapse; }
      th { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #9ca3af; padding: 10px 14px; text-align: left; border-bottom: 1px solid #f3f4f6; }
      td { padding: 12px 14px; border-bottom: 1px solid #f9fafb; font-size: 14px; color: #374151; vertical-align: middle; }
      tr:last-child td { border-bottom: none; }
      .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
      .badge-blue { background: #dbeafe; color: #1d4ed8; }
      .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 200; align-items: center; justify-content: center; }
      .modal-overlay.show { display: flex; }
      .modal-box { background: white; border-radius: 16px; padding: 32px; width: 500px; max-width: 95vw; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
      .modal-box h4 { font-size: 18px; font-weight: 700; margin-bottom: 20px; color: #111827; }
      .form-group { margin-bottom: 16px; }
      .form-group label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
      .form-group input, .form-group select, .form-group textarea {
         width: 100%; padding: 10px 14px; border: 1px solid #e5e7eb;
         border-radius: 8px; font-size: 14px; outline: none; transition: border 0.2s;
      }
      .form-group input:focus, .form-group select:focus { border-color: #2B4DFF; }
      .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
      .empty-state { text-align: center; padding: 50px 20px; color: #9ca3af; }
      .empty-state i { font-size: 48px; margin-bottom: 14px; display: block; }
      @media (max-width: 768px) {
         .sidebar { width: 100%; height: auto; position: relative; }
         .main-content { margin-left: 0; }
         .panel-layout { flex-direction: column; }
      }
   </style>
</head>
<body>
<div class="panel-layout">
   <?= $content ?>
</div>
<?php if (!empty($extraScripts)) echo $extraScripts; ?>
</body>
</html>
