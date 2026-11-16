<?php
$months = \Agenda::MONTHS;
$entry = $agendaEntries[$selectedMonth] ?? null;
$sections = $entry ? ($entry['sections'] ?? \Agenda::sectionsFromRow($entry)) : [];
$monthName = $months[$selectedMonth] ?? '';
$notes = $latestNotes ?? [];
$olderNotes = $olderNotes ?? [];
$excerpt = static function (string $text, int $length = 150): string {
   $plain = trim(preg_replace('/\s+/u', ' ', strip_tags($text)) ?? '');
   if (function_exists('mb_strlen') && mb_strlen($plain, 'UTF-8') > $length) return mb_substr($plain, 0, $length, 'UTF-8') . '…';
   return strlen($plain) > $length ? substr($plain, 0, $length) . '…' : $plain;
};
?>
<!-- breadcrumb-area-start -->
<div class="tv-breadcrumb-area tv-breadcrumb-overlay tv-breadcrumb-ptb z-index-1 fix p-relative"
   data-background="assets/img/breadcrumb/nosotros.png">
   <div class="container"><div class="row"><div class="col-lg-12">
      <div class="tv-breadcrumb-content z-index-1 text-center">
         <div class="tv-breadcrumb-title-box"><h3 class="tv-breadcrumb-title tv-spltv-text tv-spltv-in-right">Agenda Institucional</h3></div>
         <div class="tv-breadcrumb-list-wrap"><div class="tv-breadcrumb-list">
            <span><a href="<?= APP_URL ?>/home">Home</a></span>
            <span class="dvdr"><svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.47698 6.00058L0.352151 10.1253L1.53065 11.3038L6.83398 6.00058L1.53065 0.697266L0.352151 1.87577L4.47698 6.00058Z" fill="#F5F6F7" /></svg></span>
            <i>Agenda Institucional</i>
         </div></div>
      </div>
   </div></div></div>
</div>
<!-- breadcrumb-area-end -->

<section class="institutional-agenda">
   <div class="container">
      <?php if ($selectedNote): ?>
         <?php $noteImage = !empty($selectedNote['image']) ? $selectedNote['image'] : 'assets/img/blog/blog-list-thum-1.png'; ?>
         <article class="agenda-note-detail">
            <a class="agenda-note-back" href="<?= APP_URL ?>/agenda?year=<?= (int) $selectedYear ?>&amp;month=<?= (int) $selectedMonth ?>"><i class="ti ti-arrow-left" aria-hidden="true"></i> Volver</a>
            <span class="agenda-note-date"><i class="ti ti-calendar-event" aria-hidden="true"></i> <?= htmlspecialchars(date('j', strtotime($entry['updated_at'] ?? 'now')) . ' de ' . $monthName, ENT_QUOTES, 'UTF-8') ?></span>
            <?php if ($noteImage): ?><img class="agenda-note-detail-image" src="<?= APP_URL ?>/<?= htmlspecialchars($noteImage, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($selectedNote['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><?php endif; ?>
            <h1><?= nl2br(htmlspecialchars($selectedNote['title'] ?? '', ENT_QUOTES, 'UTF-8')) ?></h1>
            <div class="agenda-copy"><?= \Agenda::renderFormatted($selectedNote['text'] ?? '') ?></div>
         </article>
      <?php else: ?>
      <?php if ($notes): ?>
         <section class="monthly-news">
            <header class="monthly-news-heading"><div><span class="monthly-news-eyebrow">Agenda Mensual</span><h2>La Cámara en Acción</h2></div><?php if ($olderNotes): ?><button class="agenda-see-all" type="button" id="agenda-see-all" aria-expanded="false" aria-controls="agenda-older-notes">Ver todo <i class="ti ti-arrow-right" aria-hidden="true"></i></button><?php endif; ?></header>
            <div class="row g-3">
               <?php foreach ($notes as $note):
                  $noteTitle = trim((string) ($note['title'] ?? '')) ?: 'Novedad';
                  $noteImage = !empty($note['image']) ? $note['image'] : 'assets/img/blog/blog-list-thum-1.png';
                  $noteMonth = $months[(int) $note['month_number']] ?? '';
                  $noteDate = strtotime($note['created_at'] ?? '') ?: time();
                  $noteUrl = APP_URL . '/agenda?year=' . (int) $note['year'] . '&month=' . (int) $note['month_number'] . '&note=' . (int) $note['section_index'];
               ?>
                  <div class="col-lg-4 col-md-6"><article class="agenda-news-card h-100">
                     <a class="agenda-news-image-link" href="<?= htmlspecialchars($noteUrl, ENT_QUOTES, 'UTF-8') ?>"><img src="<?= APP_URL ?>/<?= htmlspecialchars(ltrim($noteImage, '/'), ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($noteTitle, ENT_QUOTES, 'UTF-8') ?>" loading="lazy"></a>
                     <div class="agenda-news-copy"><h3><?= htmlspecialchars($noteTitle, ENT_QUOTES, 'UTF-8') ?></h3><p><?= htmlspecialchars($excerpt((string) ($note['text'] ?? '')), ENT_QUOTES, 'UTF-8') ?></p><footer><span><i class="ti ti-calendar-event" aria-hidden="true"></i> <?= htmlspecialchars(date('j', $noteDate) . ' de ' . $noteMonth, ENT_QUOTES, 'UTF-8') ?></span><a href="<?= htmlspecialchars($noteUrl, ENT_QUOTES, 'UTF-8') ?>">Ver más...</a></footer></div>
                  </article></div>
               <?php endforeach; ?>
            </div>
            <?php if ($olderNotes): ?><div class="row g-3 agenda-older-notes" id="agenda-older-notes" hidden>
               <?php foreach ($olderNotes as $note):
                  $noteTitle = trim((string) ($note['title'] ?? '')) ?: 'Novedad';
                  $noteImage = !empty($note['image']) ? $note['image'] : 'assets/img/blog/blog-list-thum-1.png';
                  $noteMonth = $months[(int) $note['month_number']] ?? '';
                  $noteDate = strtotime($note['created_at'] ?? '') ?: time();
                  $noteUrl = APP_URL . '/agenda?year=' . (int) $note['year'] . '&month=' . (int) $note['month_number'] . '&note=' . (int) $note['section_index'];
               ?>
                  <div class="col-lg-4 col-md-6"><article class="agenda-news-card h-100">
                     <a class="agenda-news-image-link" href="<?= htmlspecialchars($noteUrl, ENT_QUOTES, 'UTF-8') ?>"><img src="<?= APP_URL ?>/<?= htmlspecialchars(ltrim($noteImage, '/'), ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($noteTitle, ENT_QUOTES, 'UTF-8') ?>" loading="lazy"></a>
                     <div class="agenda-news-copy"><h3><?= htmlspecialchars($noteTitle, ENT_QUOTES, 'UTF-8') ?></h3><p><?= htmlspecialchars($excerpt((string) ($note['text'] ?? '')), ENT_QUOTES, 'UTF-8') ?></p><footer><span><i class="ti ti-calendar-event" aria-hidden="true"></i> <?= htmlspecialchars(date('j', $noteDate) . ' de ' . $noteMonth, ENT_QUOTES, 'UTF-8') ?></span><a href="<?= htmlspecialchars($noteUrl, ENT_QUOTES, 'UTF-8') ?>">Ver más...</a></footer></div>
                  </article></div>
               <?php endforeach; ?>
            </div><?php endif; ?>
         </section>
      <?php else: ?><p class="agenda-empty">Todavía no hay notas publicadas.</p>
      <?php endif; ?>
      <?php endif; ?>
   </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
   const toggle = document.getElementById('agenda-see-all');
   const olderNotes = document.getElementById('agenda-older-notes');
   if (!toggle || !olderNotes) return;
   toggle.addEventListener('click', function () {
      const expanded = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!expanded));
      olderNotes.hidden = expanded;
      toggle.innerHTML = expanded ? 'Ver todo <i class="ti ti-arrow-right" aria-hidden="true"></i>' : 'Ver menos <i class="ti ti-arrow-up" aria-hidden="true"></i>';
   });
});
</script>

<style>
/* ==========================================================================
   1. CONTENEDOR PRINCIPAL
   ========================================================================== */
.institutional-agenda {
  padding: 80px 0 100px;
  background: #ffffff;
}

.institutional-agenda > .container {
  max-width: 1140px;
}

/* En la vista de agenda se presentan las notas en tarjetas, sin el texto largo ni el índice lateral. */
.institutional-agenda .agenda-layout { display: none; }
.institutional-agenda .agenda-month-label { margin-bottom: 18px; }
.institutional-agenda .monthly-news { margin-top: 0; padding-top: 0; border-top: 0; }

/* Etiqueta del mes */
.agenda-month-label {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  min-width: 175px;
  padding: 13px 26px;
  margin-bottom: 48px;
  border-radius: 0 0 9px 0;
  background: #05a9e0;
  color: #ffffff;
  font-size: 25px;
  font-weight: 700;
}

/* ==========================================================================
   2. ESTRUCTURA Y LAYOUT (GRID)
   ========================================================================== */
.agenda-layout {
  display: grid;
  grid-template-columns: minmax(0, 1.45fr) minmax(260px, 0.95fr);
  grid-template-rows: auto auto auto;
  column-gap: 52px;
  align-items: start;
}

.agenda-content {
  min-width: 0;
}

.agenda-section-item {
  grid-column: 1;
}

/* Línea divisoria de secciones */
.agenda-section-divider {
  grid-column: 1 / -1;
  grid-row: auto;
  width: calc(90% - 5px);
  height: 2px;
  margin: 52px auto;
  background: #072868;
  border: 2px solid #072868;
}

/* ==========================================================================
   3. TIPIFICACIÓN Y TEXTO DE ENTRADAS
   ========================================================================== */
.agenda-eyebrow {
  display: block;
  margin-bottom: 8px;
  color: #05a9e0;
  font-size: 16px;
}

.agenda-entry-title {
  margin: 0 0 18px;
  color: #0b477d;
  font-size: 36px;
  line-height: 1.25;
  font-weight: 700;
}

.agenda-copy {
  margin: 0 0 20px;
  color: #82939b;
  font-size: 18px;
  line-height: 1.65;
}

.agenda-copy p {
  margin: 0 0 14px;
}

.agenda-copy ul,
.agenda-copy ol {
  margin: 0 0 16px;
  padding-left: 23px;
}

.agenda-copy ul {
  list-style: disc;
}

.agenda-copy ol {
  list-style: decimal;
}

.agenda-copy li {
  padding-left: 3px;
  margin-bottom: 4px;
}

.agenda-copy strong,
.agenda-copy b {
  color: #0b477d;
  font-weight: 700;
}

/* Estado sin contenido (vacío) */
.agenda-empty {
  padding: 32px;
  border-radius: 12px;
  background: #f3f8fb;
  color: #647780;
  font-size: 18px;
}

/* ==========================================================================
   4. MENÚ LATERAL / ÍNDICE (SIDEBAR)
   ========================================================================== */
.agenda-index {
  grid-column: 2;
  grid-row: 1 / span 99;
  margin-top: 32px;
  padding: 30px 28px;
  background: #c8eaf8;
  border-radius: 17px 0 17px 0;
}

.agenda-index h2 {
  margin: 0 0 18px 4px;
  color: #0b477d;
  font-size: 20px;
  font-weight: 700;
}

.agenda-index nav {
  display: grid;
  gap: 10px;
}

.agenda-index nav a {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 54px;
  padding: 12px 16px;
  border-radius: 7px;
  background: #ffffff;
  color: #0b477d;
  font-size: 16px;
  text-decoration: none;
  transition: background 0.2s, color 0.2s;
}

/* Estado al pasar el cursor o botón activo */
.agenda-index nav a:hover,
.agenda-index nav a.is-active {
  background: #05a9e0;
  color: #ffffff;
}

.agenda-index-empty {
  margin: 0;
  color: #647780;
  font-size: 14px;
  line-height: 1.5;
}

/* ==========================================================================
   5. ADAPTABILIDAD A DISPOSITIVOS MÓVILES (MEDIA QUERY)
   ========================================================================== */
@media (max-width: 767px) {
  .institutional-agenda {
    padding: 52px 0 68px;
  }

  .agenda-month-label {
    margin-bottom: 30px;
  }

  /* Cambiar layout a 1 sola columna */
  .agenda-layout {
    grid-template-columns: 1fr;
    grid-template-rows: auto;
    gap: 24px;
  }

  .agenda-section-item,
  .agenda-section-divider,
  .agenda-index {
    grid-column: 1;
    grid-row: auto;
  }

  .agenda-entry-title {
    font-size: 28px;
    font-weight: 700;
  }

  .agenda-copy {
    font-size: 17px;
  }

  .agenda-section-divider {
    margin: 8px 0;
    width: 100%;
  }

  .agenda-index {
    margin-top: 0;
    padding: 24px;
  }

  /* El índice se muestra en 2 columnas en móviles */
  .agenda-index nav {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 8px;
  }
}

  .monthly-news{grid-column:1 / -1;margin-top:30px;padding-top:24px;border-top:1px solid #e3edf2}
  .monthly-news-heading{display:flex;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:22px}
  .monthly-news-eyebrow{display:block;margin-bottom:5px;color:#05a9e0;font-size:14px}
  .monthly-news-heading h2{margin:0;color:#0b477d;font-size:30px;line-height:1.2;font-weight:700}
  .monthly-news-all{color:#0b477d;font-size:13px}
  .agenda-news-card{display:flex;flex-direction:column;overflow:hidden;border-radius:12px 3px 12px 3px;background:#eaf7fc}
  .agenda-news-image-link{display:block;height:190px;overflow:hidden;background:#e0edf2}
  .agenda-news-image-link img{display:block;width:100%;height:100%;object-fit:cover;transition:transform .3s}
  .agenda-news-card:hover .agenda-news-image-link img{transform:scale(1.035)}
  .agenda-news-copy{display:flex;flex:1;flex-direction:column;padding:16px 17px 13px}
  .agenda-news-copy h3{display:-webkit-box;overflow:hidden;-webkit-line-clamp:2;-webkit-box-orient:vertical;min-height:38px;margin:0 0 8px;color:#06477e;font-size:15px;font-weight:700;line-height:1.3}
  .agenda-news-copy p{display:-webkit-box;overflow:hidden;-webkit-line-clamp:4;-webkit-box-orient:vertical;min-height:58px;margin:0 0 10px;color:#78909d;font-size:12px;line-height:1.4}
  .agenda-news-copy footer{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-top:auto;padding-top:9px;border-top:1px solid #b8d7e4;color:#758d99;font-size:11px}
  .agenda-news-copy footer a{color:#009fe3;font-size:12px;font-weight:700;text-decoration:none;white-space:nowrap}
  .agenda-note-detail{max-width:900px;margin:0 auto;padding:0 0 10px}
  .agenda-note-back{display:block;margin:0 0 7px;color:#0b3978;font-size:13px;font-weight:600;text-decoration:none}
  .agenda-note-date{display:block;margin-bottom:24px;color:#758d99;font-size:12px}
  .agenda-note-detail-image{display:block;width:100%;height:auto;max-height:480px;margin:0 auto 22px;border-radius:15px 2px 15px 2px;object-fit:cover}
  .agenda-note-detail h1{max-width:700px;margin:0 auto 20px;color:#0b477d;font-size:30px;line-height:1.2;font-weight:700;text-align:center}
  .agenda-note-detail .agenda-copy{color:#78909d;font-size:14px;line-height:1.5}
  .agenda-note-detail .agenda-copy p{margin-bottom:14px}
  .agenda-note-detail .agenda-copy strong,.agenda-note-detail .agenda-copy b{color:#0b477d}
  .agenda-see-all{display:inline-flex;align-items:center;gap:8px;padding:0;border:0;background:none;color:#0b3978;font:inherit;font-size:13px;font-weight:600;cursor:pointer}
  .agenda-see-all:hover{color:#009fe3}
  .agenda-older-notes{margin-top:0}
@media(max-width:767px){.monthly-news-heading h2{font-size:25px}.agenda-news-image-link{height:210px}.agenda-news-copy h3{font-size:16px}.agenda-news-copy p{font-size:13px;min-height:0}.agenda-note-detail-image{max-height:320px}.agenda-note-detail h1{font-size:25px}}
</style>
