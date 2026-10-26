<?php include PARTIALS_PATH . '/sidebar-admin.php'; ?>
<?php $selectedEntry = $entries[$selectedMonth] ?? ['title' => '', 'subtitle' => '', 'text_one' => '', 'text_two' => '']; ?>
<div class="main-content">
   <div class="page-header">
      <div><h1><i class="ti ti-calendar-event"></i> Agenda institucional</h1><p>Editá el contenido mensual que se muestra en la página pública.</p></div>
   </div>

   <?php if ($success === 'agenda_saved'): ?><div class="alert-success"><i class="ti ti-circle-check"></i> Contenido de <?= htmlspecialchars($months[$selectedMonth]) ?> guardado.</div><?php endif; ?>
   <?php if ($error): ?><div class="alert-error"><i class="ti ti-alert-circle"></i> No se pudo guardar. Revisá los datos e intentá nuevamente.</div><?php endif; ?>

   <div class="panel-card">
      <h3><i class="ti ti-edit"></i> Contenido de <?= htmlspecialchars($months[$selectedMonth]) ?></h3>
      <form id="agenda-content-form" method="POST" action="<?= APP_URL ?>/admin/agenda">
         <input type="hidden" name="action" value="save_agenda_month">
         <div class="form-group">
            <label for="agenda-admin-month">Mes que se guardará</label>
            <select id="agenda-admin-month" name="month_number" onchange="window.location.href='<?= APP_URL ?>/admin/agenda?month='+this.value">
               <?php foreach ($months as $number => $name): ?>
                  <option value="<?= $number ?>" <?= $number === $selectedMonth ? 'selected' : '' ?>>
                     <?= htmlspecialchars($name) ?> — <?= isset($entries[$number]) ? 'Publicado' : 'Nuevo mes' ?>
                  </option>
               <?php endforeach; ?>
            </select>
         </div>
         <section class="agenda-admin-section">
            <h4>Sección 1</h4>
            <div class="form-group"><label for="agenda-title">Título</label><input id="agenda-title" type="text" name="title" maxlength="255" value="<?= htmlspecialchars($selectedEntry['title'] ?? '') ?>" placeholder="Título de la primera sección"></div>
            <div class="form-group"><label for="agenda-text-one">Contenido</label><div class="agenda-toolbar" data-editor="agenda-text-one"><button type="button" data-command="bold" title="Negrita"><strong>B</strong></button><button type="button" data-command="insertUnorderedList" title="Lista con viñetas">• Lista</button><button type="button" data-command="insertOrderedList" title="Lista numerada">1. Lista</button></div><div id="agenda-text-one" class="agenda-rich-editor" contenteditable="true" role="textbox" aria-multiline="true" data-placeholder="Contenido de la primera sección…"><?= \Agenda::renderFormatted($selectedEntry['text_one'] ?? '') ?></div><textarea class="agenda-editor-value" name="text_one" hidden></textarea><small>Usá los controles para aplicar negrita o crear listas.</small></div>
         </section>
         <section class="agenda-admin-section">
            <h4>Sección 2</h4>
            <div class="form-group"><label for="agenda-subtitle">Título</label><input id="agenda-subtitle" type="text" name="subtitle" maxlength="255" value="<?= htmlspecialchars($selectedEntry['subtitle'] ?? '') ?>" placeholder="Título de la segunda sección"></div>
            <div class="form-group"><label for="agenda-text-two">Contenido</label><div class="agenda-toolbar" data-editor="agenda-text-two"><button type="button" data-command="bold" title="Negrita"><strong>B</strong></button><button type="button" data-command="insertUnorderedList" title="Lista con viñetas">• Lista</button><button type="button" data-command="insertOrderedList" title="Lista numerada">1. Lista</button></div><div id="agenda-text-two" class="agenda-rich-editor" contenteditable="true" role="textbox" aria-multiline="true" data-placeholder="Contenido de la segunda sección…"><?= \Agenda::renderFormatted($selectedEntry['text_two'] ?? '') ?></div><textarea class="agenda-editor-value" name="text_two" hidden></textarea><small>Usá los controles para aplicar negrita o crear listas.</small></div>
         </section>
         <button type="submit" class="btn-primary-sm"><i class="ti ti-device-floppy"></i> Guardar <?= htmlspecialchars($months[$selectedMonth]) ?></button>
      </form>
   </div>
</div>

<style>
.agenda-admin-period{display:flex;align-items:flex-end;flex-wrap:wrap;gap:14px}.agenda-admin-period .form-group{min-width:190px;margin:0}.agenda-admin-period select,#agenda-admin-month{width:100%;min-height:42px;padding:8px 11px;border:1px solid #dbe2e8;border-radius:7px;background:#fff;color:#0b477d}.agenda-admin-section{padding:20px;margin:22px 0;border:1px solid #e5e7eb;border-radius:12px;background:#fbfdff}.agenda-admin-section h4{margin:0 0 18px;color:#0b477d;font-size:17px;font-weight:700}.form-group small{display:block;margin-top:5px;color:#6b7280;font-size:12px}.agenda-toolbar{display:flex;gap:6px;padding:7px;border:1px solid #e5e7eb;border-bottom:0;border-radius:8px 8px 0 0;background:#f8fafc}.agenda-toolbar button{padding:5px 10px;border:1px solid #dbe2e8;border-radius:5px;background:#fff;color:#164b77;cursor:pointer}.agenda-toolbar button:hover{background:#e7f6fc}.agenda-rich-editor{min-height:210px;padding:12px 14px;border:1px solid #e5e7eb;border-radius:0 0 8px 8px;outline:none;line-height:1.55;white-space:normal}.agenda-rich-editor:focus{border-color:#00aae6}.agenda-rich-editor:empty:before{content:attr(data-placeholder);color:#9ca3af}.agenda-rich-editor ul,.agenda-rich-editor ol{padding-left:24px;list-style-position:outside}.agenda-rich-editor ul{list-style-type:disc}.agenda-rich-editor ol{list-style-type:decimal}
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
   document.querySelectorAll('.agenda-toolbar button').forEach(function (button) {
      button.addEventListener('mousedown', function (event) { event.preventDefault(); });
      button.addEventListener('click', function () {
         const editor = document.getElementById(button.closest('.agenda-toolbar').dataset.editor);
         editor.focus();
         document.execCommand(button.dataset.command, false, null);
      });
   });
   const form = document.getElementById('agenda-content-form');
   if (form) {
      const syncEditor = function (editorId, fieldName) {
         const editor = document.getElementById(editorId);
         const field = form.querySelector('textarea[name="' + fieldName + '"]');
         if (editor && field) field.value = editor.innerHTML;
      };
      form.querySelectorAll('.agenda-rich-editor').forEach(function (editor) {
         editor.addEventListener('input', function () {
            syncEditor(editor.id, editor.id === 'agenda-text-one' ? 'text_one' : 'text_two');
         });
      });
      form.addEventListener('submit', function () {
         syncEditor('agenda-text-one', 'text_one');
         syncEditor('agenda-text-two', 'text_two');
      });
   }
});
</script>
