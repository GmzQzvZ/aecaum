<?php include PARTIALS_PATH . '/sidebar-admin.php'; ?>
<?php $selectedEntry = $entries[$selectedMonth] ?? ['title' => '', 'subtitle' => '', 'text_one' => '', 'text_two' => '']; ?>
<div class="main-content">
   <div class="page-header">
      <div><h1><i class="ti ti-calendar-event"></i> Agenda institucional</h1><p>Seleccioná un mes para crear o editar sus dos secciones.</p></div>
   </div>

   <?php if ($success === 'agenda_saved'): ?><div class="alert-success"><i class="ti ti-circle-check"></i> Contenido de <?= htmlspecialchars($months[$selectedMonth]) ?> guardado.</div><?php endif; ?>
   <?php if ($error): ?><div class="alert-error"><i class="ti ti-alert-circle"></i> No se pudo guardar. Revisá los datos e intentá nuevamente.</div><?php endif; ?>

   <div class="panel-card">
      <h3><i class="ti ti-calendar-month"></i> Meses de la agenda</h3>
      <div class="agenda-month-grid">
         <?php foreach ($months as $number => $name): ?>
            <?php $entry = $entries[$number] ?? null; ?>
            <a class="agenda-month-card <?= $entry ? 'has-content' : 'is-empty' ?>" href="<?= APP_URL ?>/admin/agenda?month=<?= $number ?>&amp;edit=1">
               <span class="agenda-month-card-name"><?= htmlspecialchars($name) ?></span>
               <span class="agenda-month-card-status"><i class="ti <?= $entry ? 'ti-circle-check' : 'ti-circle-plus' ?>"></i> <?= $entry ? 'Editar contenido' : 'Agregar contenido' ?></span>
            </a>
         <?php endforeach; ?>
      </div>
   </div>

   <?php if ($editModal): ?>
   <div class="agenda-modal-backdrop" id="agenda-modal" role="dialog" aria-modal="true" aria-labelledby="agenda-modal-title">
      <div class="agenda-modal">
         <div class="agenda-modal-header">
            <div><span>Agenda institucional</span><h2 id="agenda-modal-title"><?= isset($entries[$selectedMonth]) ? 'Editar' : 'Agregar' ?> contenido · <?= htmlspecialchars($months[$selectedMonth]) ?></h2></div>
            <a class="agenda-modal-close" href="<?= APP_URL ?>/admin/agenda" aria-label="Cerrar">&times;</a>
         </div>
         <form id="agenda-content-form" method="POST" action="<?= APP_URL ?>/admin/agenda">
            <input type="hidden" name="action" value="save_agenda_month">
            <input type="hidden" name="month_number" value="<?= $selectedMonth ?>">
            <section class="agenda-admin-section">
               <h3>Sección 1</h3>
               <div class="form-group"><label for="agenda-title">Título</label><input id="agenda-title" type="text" name="title" maxlength="255" value="<?= htmlspecialchars($selectedEntry['title'] ?? '') ?>" placeholder="Título de la primera sección"></div>
               <div class="form-group"><label for="agenda-text-one">Contenido</label><div class="agenda-toolbar" data-editor="agenda-text-one"><button type="button" data-command="bold" title="Negrita"><strong>B</strong></button><button type="button" data-command="insertUnorderedList" title="Lista con viñetas">• Lista</button><button type="button" data-command="insertOrderedList" title="Lista numerada">1. Lista</button></div><div id="agenda-text-one" class="agenda-rich-editor" contenteditable="true" role="textbox" aria-multiline="true" data-placeholder="Contenido de la primera sección…"><?= \Agenda::renderFormatted($selectedEntry['text_one'] ?? '') ?></div><textarea name="text_one" hidden></textarea><small>Usá los controles para aplicar negrita o crear listas.</small></div>
            </section>
            <section class="agenda-admin-section">
               <h3>Sección 2</h3>
               <div class="form-group"><label for="agenda-subtitle">Título</label><input id="agenda-subtitle" type="text" name="subtitle" maxlength="255" value="<?= htmlspecialchars($selectedEntry['subtitle'] ?? '') ?>" placeholder="Título de la segunda sección"></div>
               <div class="form-group"><label for="agenda-text-two">Contenido</label><div id="agenda-text-two-toolbar" class="agenda-toolbar"><button type="button" data-command="bold" title="Negrita"><strong>B</strong></button><button type="button" data-command="insertUnorderedList" title="Lista con viñetas">• Lista</button><button type="button" data-command="insertOrderedList" title="Lista numerada">1. Lista</button></div><div id="agenda-text-two" class="agenda-rich-editor" contenteditable="true" role="textbox" aria-multiline="true" data-placeholder="Contenido de la segunda sección…"><?= \Agenda::renderFormatted($selectedEntry['text_two'] ?? '') ?></div><textarea name="text_two" hidden></textarea><small>Usá los controles para aplicar negrita o crear listas.</small></div>
            </section>
            <div class="agenda-modal-actions"><a class="btn-cancel" href="<?= APP_URL ?>/admin/agenda">Cancelar</a><button type="submit" class="btn-primary-sm"><i class="ti ti-device-floppy"></i> Guardar <?= htmlspecialchars($months[$selectedMonth]) ?></button></div>
         </form>
      </div>
   </div>
   <?php endif; ?>
</div>

<style>
.agenda-month-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px}.agenda-month-card{display:flex;min-height:112px;flex-direction:column;justify-content:space-between;padding:18px;border:1px solid #dce5ec;border-radius:12px;background:#fff;color:#0b477d;text-decoration:none;transition:transform .18s,box-shadow .18s,border-color .18s}.agenda-month-card:hover{transform:translateY(-2px);border-color:#00aae6;box-shadow:0 6px 18px #0b477d14}.agenda-month-card.has-content{background:#effaff;border-color:#b8e6f6}.agenda-month-card-name{font-size:18px;font-weight:700}.agenda-month-card-status{display:flex;align-items:center;gap:6px;color:#607787;font-size:12px}.agenda-month-card.has-content .agenda-month-card-status{color:#0878a9}
.agenda-modal-backdrop{position:fixed;inset:0;z-index:500;display:flex;align-items:center;justify-content:center;padding:24px;background:rgba(5,23,48,.64)}.agenda-modal{width:min(820px,100%);max-height:calc(100vh - 48px);overflow:auto;padding:28px;background:#fff;border-radius:16px;box-shadow:0 24px 70px #00152d55}.agenda-modal-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:22px}.agenda-modal-header span{color:#00a6db;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em}.agenda-modal-header h2{margin:5px 0 0;color:#0b477d;font-size:22px;font-weight:700}.agenda-modal-close{display:grid;width:36px;height:36px;place-items:center;border-radius:50%;background:#eff5f8;color:#0b477d;text-decoration:none;font-size:26px;line-height:1}.agenda-admin-section{padding:18px;margin:16px 0;border:1px solid #e5eaf0;border-radius:12px;background:#fbfdff}.agenda-admin-section h3{margin:0 0 16px;color:#0b477d;font-size:16px;font-weight:700}.form-group small{display:block;margin-top:5px;color:#6b7280;font-size:12px}.agenda-toolbar{display:flex;gap:6px;padding:7px;border:1px solid #e5e7eb;border-bottom:0;border-radius:8px 8px 0 0;background:#f8fafc}.agenda-toolbar button{padding:5px 10px;border:1px solid #dbe2e8;border-radius:5px;background:#fff;color:#164b77;cursor:pointer}.agenda-rich-editor{min-height:160px;padding:12px 14px;border:1px solid #e5e7eb;border-radius:0 0 8px 8px;outline:none;line-height:1.55}.agenda-rich-editor:focus{border-color:#00aae6}.agenda-rich-editor:empty:before{content:attr(data-placeholder);color:#9ca3af}.agenda-rich-editor ul,.agenda-rich-editor ol{padding-left:24px}.agenda-modal-actions{display:flex;justify-content:flex-end;align-items:center;gap:12px;padding-top:8px}.btn-cancel{padding:8px 16px;border-radius:8px;background:#eef2f5;color:#425466;text-decoration:none;font-size:13px}@media(max-width:700px){.agenda-month-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.agenda-modal{padding:18px}.agenda-admin-section{padding:14px}}@media(max-width:420px){.agenda-month-grid{grid-template-columns:1fr}}
</style>
<?php if ($editModal): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
   document.querySelectorAll('.agenda-toolbar button').forEach(function (button) {
      button.addEventListener('mousedown', function (event) { event.preventDefault(); });
      button.addEventListener('click', function () {
         const editorId = button.closest('.agenda-admin-section').querySelector('.agenda-rich-editor').id;
         const editor = document.getElementById(editorId);
         editor.focus();
         document.execCommand(button.dataset.command, false, null);
      });
   });
   const form = document.getElementById('agenda-content-form');
   if (form) form.addEventListener('submit', function () {
      form.querySelectorAll('.agenda-rich-editor').forEach(function (editor) {
         const fieldName = editor.id === 'agenda-text-one' ? 'text_one' : 'text_two';
         const field = form.querySelector('textarea[name="' + fieldName + '"]');
         if (field) field.value = editor.innerHTML;
      });
   });
   document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') window.location.href = '<?= APP_URL ?>/admin/agenda';
   });
});
</script>
<?php endif; ?>
