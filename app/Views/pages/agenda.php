<?php
$months = \Agenda::MONTHS;
$entry = $agendaEntries[$selectedMonth] ?? null;
$sections = $entry ? ($entry['sections'] ?? \Agenda::sectionsFromRow($entry)) : [];
$monthName = $months[$selectedMonth] ?? '';
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
      <div class="agenda-month-label"><?= htmlspecialchars($monthName) ?></div>
      <div class="agenda-layout">
         <?php if (!$entry): ?>
            <article class="agenda-content agenda-empty">Todavía no hay contenido publicado para <?= htmlspecialchars($monthName) ?>.</article>
         <?php else: ?>
            <?php $renderedSections = 0; foreach ($sections as $section): ?>
               <?php if (trim((string) ($section['title'] ?? '')) === '' && trim(strip_tags((string) ($section['text'] ?? ''))) === '') continue; ?>
               <?php if ($renderedSections > 0): ?><hr class="agenda-section-divider"><?php endif; ?>
               <article class="agenda-content agenda-section-item">
                  <span class="agenda-eyebrow">Agenda Mensual</span>
                  <?php if (!empty($section['title'])): ?><h<?= $renderedSections === 0 ? '1' : '2' ?> class="agenda-entry-title"><?= nl2br(htmlspecialchars($section['title'], ENT_QUOTES, 'UTF-8')) ?></h<?= $renderedSections === 0 ? '1' : '2' ?>><?php endif; ?>
                  <?php if (!empty($section['text'])): ?><div class="agenda-copy"><?= \Agenda::renderFormatted($section['text']) ?></div><?php endif; ?>
               </article>
            <?php $renderedSections++; endforeach; ?>
         <?php endif; ?>
         <aside class="agenda-index" aria-label="Índice de meses">
            <h2>Nuestro Año</h2>
            <nav aria-label="Meses del año">
               <?php foreach ($agendaEntries as $number => $_entry): ?>
                  <?php $name = $months[$number] ?? ''; ?>
                  <a href="<?= APP_URL ?>/agenda?month=<?= $number ?>" class="<?= $number === $selectedMonth ? 'is-active' : '' ?>" <?= $number === $selectedMonth ? 'aria-current="page"' : '' ?>>
                     <?= htmlspecialchars($name) ?>
                  </a>
               <?php endforeach; ?>
            </nav>
         </aside>
      </div>
   </div>
</section>

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
</style>
