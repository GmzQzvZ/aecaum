<?php
$months = \Agenda::MONTHS;
$entry = $agendaEntries[$selectedMonth] ?? null;
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
            <article class="agenda-content agenda-section-one">
               <span class="agenda-eyebrow">Agenda Mensual</span>
               <?php if (!empty($entry['title'])): ?><h1 class="agenda-entry-title"><?= nl2br(htmlspecialchars($entry['title'])) ?></h1><?php endif; ?>
               <?php if (!empty($entry['text_one'])): ?><div class="agenda-copy"><?= \Agenda::renderFormatted($entry['text_one']) ?></div><?php endif; ?>
            </article>
            <?php if (!empty($entry['text_one']) && !empty($entry['text_two'])): ?>
                <hr class="agenda-section-divider"><?php endif; ?>
            <article class="agenda-content agenda-section-two">
               <span class="agenda-eyebrow">Agenda Mensual</span>
               <?php if (!empty($entry['subtitle'])): ?><h2 class="agenda-entry-title"><?= nl2br(htmlspecialchars($entry['subtitle'])) ?></h2><?php endif; ?>
               <?php if (!empty($entry['text_two'])): ?><div class="agenda-copy"><?= \Agenda::renderFormatted($entry['text_two']) ?></div><?php endif; ?>
            </article>
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
.institutional-agenda{padding:80px 0 100px;background:#fff}.institutional-agenda>.container{max-width:910px}
.agenda-month-label{display:inline-flex;min-width:160px;justify-content:center;align-items:center;padding:11px 24px;margin-bottom:48px;border-radius:0 0 9px 0;background:#05a9e0;color:#fff;font-size:23px;font-weight:700}
.agenda-layout{display:grid;grid-template-columns:minmax(0,1.45fr) minmax(260px,.95fr);grid-template-rows:auto auto auto;column-gap:52px;align-items:start}
.agenda-content{min-width:0}.agenda-section-one{grid-column:1;grid-row:1}.agenda-section-two{grid-column:1;grid-row:3}.agenda-eyebrow{display:block;margin-bottom:8px;color:#05a9e0;font-size:14px}.agenda-entry-title{margin:0 0 18px;color:#0b477d;font-size:36px;line-height:1.22;font-weight:750}.agenda-copy{margin:0 0 20px;color:#82939b;font-size:15px;line-height:1.55}.agenda-copy p{margin:0 0 14px}.agenda-copy ul,.agenda-copy ol{margin:0 0 16px;padding-left:23px}.agenda-copy ul{list-style:disc}.agenda-copy ol{list-style:decimal}.agenda-copy li{padding-left:3px;margin-bottom:4px}.agenda-copy strong,.agenda-copy b{color:#0b477d;font-weight:700}.agenda-section-divider{grid-column:1/-1;grid-row:2;width:calc(100% - 5px);height:5px;margin:52px auto;background:#07366d;border:0}
.agenda-index{grid-column:2;grid-row:1/4;margin-top:32px;padding:30px 28px;background:#c8eaf8;border-radius:17px 0 17px 0}.agenda-index h2{margin:0 0 18px 4px;color:#0b477d;font-size:17px;font-weight:700}.agenda-index nav{display:grid;gap:10px}.agenda-index nav a{display:flex;min-height:49px;justify-content:center;align-items:center;padding:10px 14px;border-radius:7px;background:#fff;color:#0b477d;font-size:14px;text-decoration:none;transition:background .2s,color .2s}.agenda-index nav a:hover,.agenda-index nav a.is-active{background:#05a9e0;color:#fff}.agenda-index-empty{margin:0;color:#647780;font-size:14px;line-height:1.5}.agenda-empty{padding:32px;border-radius:12px;background:#f3f8fb;color:#647780;font-size:16px}
@media(max-width:767px){.institutional-agenda{padding:52px 0 68px}.agenda-month-label{margin-bottom:30px}.agenda-layout{grid-template-columns:1fr;grid-template-rows:auto;gap:24px}.agenda-section-one,.agenda-section-two,
.agenda-section-divider,.agenda-index
{grid-column:0.5;
grid-row:auto}.agenda-entry-title{font-size:29px}.agenda-section-divider{margin:8px 0;width:100%}.agenda-index{margin-top:0;padding:24px}.agenda-index nav{grid-template-columns:repeat(2,minmax(0,1fr));gap:8px}}
</style>
