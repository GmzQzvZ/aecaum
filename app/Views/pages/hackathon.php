

      <!-- breadcrumb-area-start -->
      <div class="tv-breadcrumb-area tv-breadcrumb-overlay tv-breadcrumb-ptb z-index-1 fix p-relative"
         data-background="assets/img/breadcrumb/nosotros.png">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="tv-breadcrumb-content z-index-1 text-center">
                     <div class="tv-breadcrumb-title-box">
                        <h3 class="tv-breadcrumb-title tv-spltv-text tv-spltv-in-right">Hackathon</h3>
                     </div>
                     <div class="tv-breadcrumb-list-wrap">
                        <div class="tv-breadcrumb-list">
                           <span><a href="index.html">Home</a></span>
                           <span class="dvdr">/</span>
                           <i>Hackathon</i>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>      
      <!-- breadcrumb-area-end -->
   <div class="tv-blog-area pt-130 pb-130">
   <div class="container">
      <div class="text-center">
         <h1 class="tv-slider-title " style="font-weight:900; font-size:44px;">1° Hackathon de la Última Milla</h1>
         <h2 style=" color:#00aae6 ;font-weight:900; font-size:20px;">una iniciativa de AECAUM</h2>
         <p style="color:#6d8089; font-size:20px;">Desde AECAUM impulsamos el 1° Hackatón de Última Milla, diseñado para impactar 
         directamente en el ecosistema logístico de última milla.</p>
      </div>
      <div class="row">
         <div class="col-xl-8 col-lg-8 col-12">
            <div class="tv-blog-list-wrap">
               <div class="tv-blog-details">
                  <div class="tv-blog-details-thumb mb-20">
                     <img loading="lazy" src="assets/img/project/Hackathon.png" alt="logistica" style="width: 100%; height: 380px; object-fit: cover; object-position: top; border-radius: 25px 0 25px 0;">
                  </div>
                  <div class="tv-blog-details-content">
                     <span class="tv-section-subtitle tv-spltv-text tv-spltv-in-right">¡Sumate hoy y forma parte del cambio!</span>
                     <h1 class="tv-section-title" style="font-size: 30px;"><strong style="font-size:38px;">Trabajo en equipo</strong></h1>
                     <p style="font-size:18px;">Se llevará a cabo el sábado 7 de noviembre de 2026, en el marco del 2° 
                        Congreso de Logística de la Universidad de Almirante Brown. La 
                        participación será presencial en el Campus UNaB, Blas Parera 132, Burzaco.</p>
                     <p style="font-size:18px;">Buscamos mentes creativas y equipos multidisciplinarios dispuestos a desarrollar soluciones en:</p>
                     <ul style="margin-left: 30px; font-size: 18px;">
                        <li>Optimización de rutas e Inteligencia Artificial.</li>
                        <li>Logística verde y entregas de cero emisiones.</li>
                        <li> Experiencia de cliente y tecnología para la entrega final.</li>
                     </ul>
                     <br>
                     <p style="font-size: 18px;">Si tenes una idea o queres poner a prueba tus habilidades resolviendo problemas reales de la industria, este es tu lugar.</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-4 col-lg-4 col-12">
            <div class="tv-widget widget mb-30  wow-itfadeUp" data-wow-duratoin=".9s" data-wow-delay=".3s"
               style="background-color: #c2e6f3; min-height: 700px; display: flex; flex-direction: column; justify-content: center;">
               <img loading="lazy" src="assets/img/project/Qr hackathon.png" style="width: 135%; max-width: none; height: 600px; object-fit: contain; align-self: center;">
            <h2 class="text-center" style=" color:#00aae6; font-size:20px;">¡Sumate hoy y forma parte del cambio!</h2>
            </div>
         </div>
   </div>
   </div>
   </div>

<?php
$hackathonHosts = [
   ['name' => 'MARCELA MARÓN', 'role' => 'Sincronística. Moderadora', 'image' => 'Hackaton-87.png'],
   ['name' => 'ROMINA VERSTRAETE', 'role' => 'Coordinadora Hackathon', 'image' => 'Hackaton-88.png'],
   ['name' => 'BÁRBARA ANZINI', 'role' => 'Gerente Ejecutiva Aeca Última Milla. Embajadora De Premiación', 'image' => 'Hackaton-91.png'],
   ['name' => 'KARINA MACARIO', 'role' => 'Urbano. Embajadora De Premiación', 'image' => 'Hackaton-89.png'],
];
$hackathonJury = [
   ['name' => 'IGNACIO RODRÍGUEZ QUINTANA', 'role' => 'AECA - Última Milla', 'image' => 'ANfitriones-91.png'],
   ['name' => 'JULIETA DAFFONCHIO', 'role' => 'Directora Ejecutiva - FAETYL', 'image' => 'Hackaton-92.png'],
   ['name' => 'RAFAEL RODRÍGUEZ RODA', 'role' => 'Director Ejecutivo CEDOL', 'image' => 'Hackaton-94.png'],
   ['name' => 'GABRIELA SIUEL', 'role' => 'Directora - UNAB', 'image' => 'ANfitriones-94.png'],
   ['name' => 'GERARDO ROJAS', 'role' => 'Presidente - UIAB', 'image' => 'Hackaton-95.png'],
   ['name' => 'PABLO BELTRÁN', 'role' => 'Miembro Comisión Directiva - ARLOG', 'image' => 'Hackaton-96.png'],
   ['name' => 'DIEGO BERARDO', 'role' => 'Vicepresidente - CESSI', 'image' => 'Hackaton-98.png'],
];
?>
<section class="hackathon-people" aria-label="Anfitriones y jurado del Hackathon">
   <div class="container hackathon-people-container">
      <img class="hackathon-mascot" src="assets/img/Hackatong/mascota2.png" alt="Mascota del Hackathon AECAUM" loading="lazy">
      <div class="hackathon-people-heading"><span>Nuestros</span><h2>Anfitriones</h2></div>
      <div class="hackathon-people-grid hackathon-hosts">
         <?php foreach ($hackathonHosts as $person): ?>
            <article class="hackathon-person">
               <div class="hackathon-person-copy"><h3><?= htmlspecialchars($person['name']) ?></h3><p><?= htmlspecialchars($person['role']) ?></p></div>
               <img src="assets/img/Hackatong/<?= htmlspecialchars($person['image']) ?>" alt="<?= htmlspecialchars($person['name']) ?>" loading="lazy">
            </article>
         <?php endforeach; ?>
      </div>

      <div class="hackathon-people-heading hackathon-jury-heading"><span>Nuestros</span><h2>Jurados</h2></div>
      <div class="hackathon-people-grid hackathon-jury">
         <?php foreach ($hackathonJury as $person): ?>
            <article class="hackathon-person">
               <div class="hackathon-person-copy"><h3><?= htmlspecialchars($person['name']) ?></h3><p><?= htmlspecialchars($person['role']) ?></p></div>
               <?php if ($person['image']): ?>
                  <img src="assets/img/Hackatong/<?= htmlspecialchars($person['image']) ?>" alt="<?= htmlspecialchars($person['name']) ?>" loading="lazy">
               <?php else: ?>
                  <div class="hackathon-person-placeholder" role="img" aria-label="Retrato no disponible: <?= htmlspecialchars($person['name']) ?>"><?= htmlspecialchars($person['initials']) ?></div>
               <?php endif; ?>
            </article>
         <?php endforeach; ?>
      </div>
   </div>
</section>
<style>
.hackathon-people{position:relative;overflow:visible;padding:56px 0 88px;background:#e3f4fc}.hackathon-people-container{position:relative;max-width:1140px}.hackathon-mascot{position:absolute;z-index:2;top:-175px;right:8px;width:250px;height:auto;object-fit:contain}.hackathon-people-heading{margin:0 0 28px}.hackathon-people-heading span{color:#00a9e0;font-size:14px;font-weight:700}.hackathon-people-heading h2{margin:0;color:#064d84;font-size:36px;line-height:1.1;font-weight:750}.hackathon-people-grid{display:grid;grid-template-columns:1fr 1fr;column-gap:32px;row-gap:20px;max-width:900px;margin:0 auto}.hackathon-person{display:grid;grid-template-columns:minmax(0,1fr) 112px;gap:16px;align-items:end;min-height:112px}.hackathon-person:nth-child(even){grid-template-columns:112px minmax(0,1fr)}.hackathon-person:nth-child(even) .hackathon-person-copy{grid-column:2;grid-row:1;text-align:left}.hackathon-person:nth-child(even)>img,.hackathon-person:nth-child(even)>.hackathon-person-placeholder{grid-column:1;grid-row:1}.hackathon-person-copy{align-self:end;padding-bottom:8px;text-align:right}.hackathon-person-copy h3{margin:0;color:#07508b;font-size:14px;line-height:1.25;font-weight:750}.hackathon-person-copy p{margin:0;color:#7a929f;font-size:13px;line-height:1.3}.hackathon-person>img,.hackathon-person-placeholder{display:grid;width:112px;height:112px;place-items:center;object-fit:cover;border-radius:16px 0 16px 0}.hackathon-person-placeholder{background:#c5e7f5;color:#0b568f;font-size:28px;font-weight:700}.hackathon-jury-heading{margin-top:70px}.hackathon-jury{row-gap:20px}.hackathon-person:nth-child(odd) .hackathon-person-copy{grid-column:1}.hackathon-person:nth-child(odd)>img,.hackathon-person:nth-child(odd)>.hackathon-person-placeholder{grid-column:2}.hackathon-jury .hackathon-person:nth-last-child(1):nth-child(odd){grid-column:1}.hackathon-lineup{position:relative}
@media(max-width:767px){.hackathon-people{padding:44px 0 60px}.hackathon-mascot{top:-125px;right:0;width:155px}.hackathon-people-heading h2{font-size:30px}.hackathon-people-grid{grid-template-columns:1fr;max-width:500px;row-gap:14px}.hackathon-person,.hackathon-person:nth-child(even){grid-template-columns:minmax(0,1fr) 96px;min-height:96px;gap:14px}.hackathon-person:nth-child(even) .hackathon-person-copy{grid-column:1;grid-row:1;text-align:right}.hackathon-person:nth-child(even)>img,.hackathon-person:nth-child(even)>.hackathon-person-placeholder{grid-column:2;grid-row:1}.hackathon-person>img,.hackathon-person-placeholder{width:96px;height:96px}.hackathon-person-copy h3{font-size:12px}.hackathon-person-copy p{font-size:11px}.hackathon-jury-heading{margin-top:48px}}
</style>
<br>
<br>
<!-- seccion1 -->
   <section class="hackathon-lineup hackathon-lineup-intro" aria-labelledby="hackathon-lineup-title">
      <div class="container">
         <h2 id="hackathon-lineup-title">LineUp</h2>
         <div class="hackathon-lineup-list">
            <article class="hackathon-lineup-item">
               <div class="hackathon-lineup-label">Hora</div>
               <div class="hackathon-lineup-card">
                  <time class="hackathon-lineup-time" datetime="12:00">12:00 hr.</time>
                  <div class="hackathon-lineup-description">
                     <h3>ESCENARIO PRINCIPAL:</h3>
                     <p>Bienvenida, presentación del jurado y coordinadores</p>
                  </div>
               </div>
            </article>
            <article class="hackathon-lineup-item">
               <div class="hackathon-lineup-label">Hora</div>
               <div class="hackathon-lineup-card hackathon-lineup-card-filled">
                  <time class="hackathon-lineup-time" datetime="12:30">12:30 hr.</time>
                  <div class="hackathon-lineup-description">
                     <h3>AULA MAGNA:</h3>
                     <p>Presentación de problemáticas a trabajar y reglas<br class="hackathon-lineup-break"> de trabajo por equipo</p>
                  </div>
               </div>
            </article>
            <p class="hackathon-lineup-talks"><strong>AULA 7:</strong> Ciclo de charlas abiertas:</p>
         </div>
      </div>
   </section>
   <style>
   .hackathon-lineup-intro{padding:0 0 64px}.hackathon-lineup-intro h2{margin:0 0 38px;font-size:30px;line-height:1.1}.hackathon-lineup-intro .hackathon-lineup-list{gap:8px}.hackathon-lineup-intro .hackathon-lineup-item{grid-template-columns:35px minmax(0,1fr);gap:8px;min-height:86px}.hackathon-lineup-intro .hackathon-lineup-label{font-size:16px}.hackathon-lineup-intro .hackathon-lineup-card{grid-template-columns:170px minmax(0,1fr);min-height:86px;padding:12px 18px 12px 30px;border-width:1.5px;border-radius:25px 0 38px 0}.hackathon-lineup-intro .hackathon-lineup-card-filled{border-color:#c9e9f8;background:#c9e9f8}.hackathon-lineup-intro .hackathon-lineup-time{border-right-width:1.5px;font-size:28px}.hackathon-lineup-intro .hackathon-lineup-description{padding-left:26px;font-size:16px;line-height:1.04}.hackathon-lineup-intro .hackathon-lineup-description h3{font-size:16px;font-weight:700}.hackathon-lineup-intro .hackathon-lineup-talks{margin:30px 0 0;text-align:center;color:#00aae6;font-size:18px;line-height:1.3}.hackathon-lineup-intro .hackathon-lineup-talks strong{font-weight:700}
   @media(max-width:767px){.hackathon-lineup-intro{padding-bottom:42px}.hackathon-lineup-intro h2{margin-bottom:24px;font-size:28px}.hackathon-lineup-intro .hackathon-lineup-item{grid-template-columns:30px minmax(0,1fr);min-height:76px}.hackathon-lineup-intro .hackathon-lineup-card{grid-template-columns:120px minmax(0,1fr);min-height:76px;padding:10px 12px 10px 16px;border-radius:20px 0 30px 0}.hackathon-lineup-intro .hackathon-lineup-time{font-size:21px}.hackathon-lineup-intro .hackathon-lineup-description{padding-left:14px;font-size:13px}.hackathon-lineup-intro .hackathon-lineup-description h3{font-size:13px}.hackathon-lineup-intro .hackathon-lineup-label{font-size:14px}.hackathon-lineup-intro .hackathon-lineup-talks{font-size:15px}}
   @media(max-width:420px){.hackathon-lineup-intro .hackathon-lineup-card{grid-template-columns:96px minmax(0,1fr);padding:8px}.hackathon-lineup-intro .hackathon-lineup-time{font-size:18px}.hackathon-lineup-intro .hackathon-lineup-description,.hackathon-lineup-intro .hackathon-lineup-description h3{font-size:11px;padding-left:8px}}
   </style>
<!-- seccion2 -->
   <section class="hackathon-lineup hackathon-lineup-secondary" aria-label="Charlas del ciclo">
      <div class="container">
         <div class="hackathon-lineup-list">
            <article class="hackathon-lineup-item">
               <div class="hackathon-lineup-label">Hora</div>
               <div class="hackathon-lineup-card">
                  <time class="hackathon-lineup-time" datetime="13:00">13:00 hr.</time>
                  <div class="hackathon-lineup-description">
                     <h3>RETO EN SALUD:</h3>
                     <p>La Última Milla, con Natalia Montenegro</p>
                     <p><strong>Urbano Express</strong></p>
                  </div>
               </div>
            </article>
            <article class="hackathon-lineup-item">
               <div class="hackathon-lineup-label">Hora</div>
               <div class="hackathon-lineup-card hackathon-lineup-card-filled">
                  <time class="hackathon-lineup-time" datetime="13:20">13:20 hr.</time>
                  <div class="hackathon-lineup-description">
                     <h3>ÚLTIMA MILLA:</h3>
                     <p>El último paso de la logística o el primero de una nueva experiencia? Con Gabriel Lucchesi de <strong>OCASA</strong></p>
                  </div>
               </div>
            </article>
            <article class="hackathon-lineup-item">
               <div class="hackathon-lineup-label">Hora</div>
               <div class="hackathon-lineup-card hackathon-lineup-card-filled">
                  <time class="hackathon-lineup-time" datetime="13:40">13:40 hr.</time>
                  <div class="hackathon-lineup-description">
                     <h3>IA EN LA ÚLTIMA MILLA:</h3>
                     <p>con Sebastián Suarez de <strong>CESSI</strong></p>
                  </div>
               </div>
            </article>
            <article class="hackathon-lineup-item">
               <div class="hackathon-lineup-label">Hora</div>
               <div class="hackathon-lineup-card">
                  <time class="hackathon-lineup-time" datetime="14:00">14:00 hr.</time>
                  <div class="hackathon-lineup-description">
                     <h3>DATO MATA RELATO:</h3>
                     <p>Más allá del promedio con Tamara Pardieux de <strong>OCASA</strong></p>
                  </div>
               </div>
            </article>
            <article class="hackathon-lineup-item">
               <div class="hackathon-lineup-label">Hora</div>
               <div class="hackathon-lineup-card">
                  <time class="hackathon-lineup-time" datetime="14:15">14:15 hr.</time>
                  <div class="hackathon-lineup-description">
                     <h3>DEL CORREO DE LAS CARTAS AL CORREO DE LAS COSAS:</h3>
                     <p>20 oportunidades, con Gaston Mamone de <strong>Blue Mail</strong> y Mariano Carrasco de <strong>iFlow</strong></p>
                  </div>
               </div>
            </article>
            <article class="hackathon-lineup-item">
               <div class="hackathon-lineup-label">Hora</div>
               <div class="hackathon-lineup-card">
                  <time class="hackathon-lineup-time" datetime="14:45">14:45 hr.</time>
                  <div class="hackathon-lineup-description">
                     <h3>MITOS Y VERDADES DE TU IA DE CADA DÍA:</h3>
                     <p>con Emilio Suad de <strong>La Postal</strong></p>
                  </div>
               </div>
            </article>
         </div>
      </div>
   </section>
   <style>
   .hackathon-lineup-secondary{padding:0 0 56px}.hackathon-lineup-secondary .hackathon-lineup-list{gap:10px}.hackathon-lineup-secondary .hackathon-lineup-item{grid-template-columns:35px minmax(0,1fr);gap:8px;min-height:88px}.hackathon-lineup-secondary .hackathon-lineup-label{font-size:16px}.hackathon-lineup-secondary .hackathon-lineup-card{grid-template-columns:170px minmax(0,1fr);min-height:88px;padding:12px 18px 12px 30px;border-width:1.5px;border-radius:25px 0 38px 0}.hackathon-lineup-secondary .hackathon-lineup-time{border-right-width:1.5px;font-size:28px}.hackathon-lineup-secondary .hackathon-lineup-description{padding-left:26px;font-size:16px;line-height:1.04}.hackathon-lineup-secondary .hackathon-lineup-description h3{font-size:16px;font-weight:700}.hackathon-lineup-secondary .hackathon-lineup-item:nth-child(3n + 1) .hackathon-lineup-time{border-color:#fff;color:#fff}.hackathon-lineup-secondary .hackathon-lineup-item:nth-child(3n + 1) .hackathon-lineup-description h3,.hackathon-lineup-secondary .hackathon-lineup-item:nth-child(3n + 1) .hackathon-lineup-description p{color:#fff}.hackathon-lineup-secondary .hackathon-lineup-item:nth-child(3n + 2) .hackathon-lineup-time{border-color:#004b87;color:#004b87}.hackathon-lineup-secondary .hackathon-lineup-item:nth-child(3n + 2) .hackathon-lineup-description h3,.hackathon-lineup-secondary .hackathon-lineup-item:nth-child(3n + 2) .hackathon-lineup-description p{color:#004b87}.hackathon-lineup-secondary .hackathon-lineup-item:nth-child(3n) .hackathon-lineup-time{border-color:#004b87;color:#004b87}.hackathon-lineup-secondary .hackathon-lineup-item:nth-child(3n) .hackathon-lineup-description h3,.hackathon-lineup-secondary .hackathon-lineup-item:nth-child(3n) .hackathon-lineup-description p{color:#004b87}
   @media(max-width:767px){.hackathon-lineup-secondary .hackathon-lineup-item{grid-template-columns:30px minmax(0,1fr);min-height:76px}.hackathon-lineup-secondary .hackathon-lineup-card{grid-template-columns:120px minmax(0,1fr);min-height:76px;padding:10px 12px 10px 16px;border-radius:20px 0 30px 0}.hackathon-lineup-secondary .hackathon-lineup-time{font-size:21px}.hackathon-lineup-secondary .hackathon-lineup-description{padding-left:14px;font-size:13px}.hackathon-lineup-secondary .hackathon-lineup-description h3{font-size:13px}.hackathon-lineup-secondary .hackathon-lineup-label{font-size:14px}}
   @media(max-width:420px){.hackathon-lineup-secondary .hackathon-lineup-card{grid-template-columns:96px minmax(0,1fr);padding:8px}.hackathon-lineup-secondary .hackathon-lineup-time{font-size:18px}.hackathon-lineup-secondary .hackathon-lineup-description,.hackathon-lineup-secondary .hackathon-lineup-description h3{font-size:11px;padding-left:8px}}
   </style>
<!-- seccion3 -->
   <section class="hackathon-lineup-final" aria-label="Presentaciones y cierre">
      <div class="container">
         <div class="hackathon-lineup-final-list">
            <article class="hackathon-lineup-final-item">
               <div class="hackathon-lineup-final-label">Hora</div>
               <div class="hackathon-lineup-final-card">
                  <time class="hackathon-lineup-final-time" datetime="15:00">15:00 hr.</time>
                  <div class="hackathon-lineup-final-description">
                     <span class="hackathon-lineup-final-stage">AULA MAGNA</span>
                     <p>Exposición y defensa de las soluciones de cada equipo</p>
                  </div>
               </div>
            </article>
            <article class="hackathon-lineup-final-item">
               <div class="hackathon-lineup-final-label">Hora</div>
               <div class="hackathon-lineup-final-card hackathon-lineup-final-card-filled">
                  <time class="hackathon-lineup-final-time" datetime="16:15">16:15 hr.</time>
                  <div class="hackathon-lineup-final-description">
                     <span class="hackathon-lineup-final-stage">AULA MAGNA</span>
                     <p>Devoluciones del Jurado</p>
                  </div>
               </div>
            </article>
            <article class="hackathon-lineup-final-item">
               <div class="hackathon-lineup-final-label">Hora</div>
               <div class="hackathon-lineup-final-card">
                  <time class="hackathon-lineup-final-time" datetime="16:30">16:30 hr.</time>
                  <div class="hackathon-lineup-final-description">
                     <span class="hackathon-lineup-final-stage">ESCENARIO PRINCIPAL</span>
                     <p>Premiación y cierre del Hackathon</p>
                  </div>
               </div>
            </article>
         </div>
      </div>
      <div class="hackathon-closing-brand">
         <img src="assets/img/Hackatong/mascota1.png" alt="Mascota del Hackathon AECAUM" loading="lazy">
         <p>#Somos<br>La&Uacute;ltimaMilla</p>
      </div>
   </section>
   <style>
   .hackathon-lineup-final{padding:0 0 60px}.hackathon-lineup-final-list{gap:8px}.hackathon-lineup-final-item{grid-template-columns:35px minmax(0,1fr);gap:8px;min-height:88px}.hackathon-lineup-final-label{font-size:16px}.hackathon-lineup-final-card{grid-template-columns:170px minmax(0,1fr);min-height:88px;padding:12px 18px 12px 30px;border-width:1.5px;border-radius:25px 0 38px 0}.hackathon-lineup-final-card-filled{border-color:#c9e9f8;background:#c9e9f8}.hackathon-lineup-final-time{border-right-width:1.5px;font-size:28px}.hackathon-lineup-final-description{padding:16px 0 0 26px;font-size:16px;line-height:1.1}.hackathon-lineup-final-stage{top:-18px;left:50%;transform:translateX(-50%);min-height:44px;border-radius:7px 0 7px 0;padding:0 27px;font-size:18px}.hackathon-closing-brand{display:flex;align-items:center;justify-content:center;gap:18px;margin:22px auto 0}.hackathon-closing-brand img{width:200px;height:230px;object-fit:contain}.hackathon-closing-brand p{margin:0;color:#00aae6;font-size:22px;font-style:italic;line-height:1.05}
   @media(max-width:767px){.hackathon-lineup-final-item{grid-template-columns:30px minmax(0,1fr);min-height:76px}.hackathon-lineup-final-card{grid-template-columns:120px minmax(0,1fr);min-height:76px;padding:10px 12px 10px 16px;border-radius:20px 0 30px 0}.hackathon-lineup-final-time{border-bottom:0;border-right:1.5px solid #004b87;padding:0;font-size:21px}.hackathon-lineup-final-card-filled .hackathon-lineup-final-time{border-color:#004b87}.hackathon-lineup-final-description{padding:15px 0 0 14px;font-size:13px}.hackathon-lineup-final-stage{top:-15px;left:145px;min-height:34px;padding:0 14px;font-size:14px}.hackathon-lineup-final-label{font-size:14px}.hackathon-closing-brand img{width:150px;height:175px}.hackathon-closing-brand p{font-size:18px}}
   @media(max-width:420px){.hackathon-lineup-final-card{grid-template-columns:96px minmax(0,1fr);padding:8px}.hackathon-lineup-final-time{font-size:18px}.hackathon-lineup-final-description{padding-left:8px;font-size:11px}.hackathon-lineup-final-stage{left:112px;min-height:29px;font-size:11px;padding:0 9px}.hackathon-closing-brand img{width:125px;height:145px}.hackathon-closing-brand p{font-size:16px}}
   </style>
   <style>
   .hackathon-lineup-intro h2{font-size:38px}.hackathon-lineup-intro .hackathon-lineup-item,.hackathon-lineup-secondary .hackathon-lineup-item,.hackathon-lineup-final-item{grid-template-columns:44px minmax(0,1fr);gap:10px;min-height:108px}.hackathon-lineup-intro .hackathon-lineup-label,.hackathon-lineup-secondary .hackathon-lineup-label,.hackathon-lineup-final-label{font-size:20px}.hackathon-lineup-intro .hackathon-lineup-card,.hackathon-lineup-secondary .hackathon-lineup-card,.hackathon-lineup-final-card{grid-template-columns:210px minmax(0,1fr);min-height:108px;padding:16px 22px 16px 36px;border-radius:30px 0 46px 0}.hackathon-lineup-intro .hackathon-lineup-time,.hackathon-lineup-secondary .hackathon-lineup-time,.hackathon-lineup-final-time{font-size:35px}.hackathon-lineup-intro .hackathon-lineup-description,.hackathon-lineup-secondary .hackathon-lineup-description,.hackathon-lineup-final-description{padding-left:32px;font-size:20px}.hackathon-lineup-intro .hackathon-lineup-description h3,.hackathon-lineup-secondary .hackathon-lineup-description h3{font-size:20px}.hackathon-lineup-intro .hackathon-lineup-talks{font-size:22px}.hackathon-lineup-final-stage{left:50%;min-height:52px;padding:0 32px;font-size:21px}.hackathon-closing-brand img{width:250px;height:285px}.hackathon-closing-brand p{font-size:28px}
   @media(max-width:767px){.hackathon-lineup-intro h2{font-size:32px}.hackathon-lineup-intro .hackathon-lineup-item,.hackathon-lineup-secondary .hackathon-lineup-item,.hackathon-lineup-final-item{grid-template-columns:36px minmax(0,1fr);min-height:92px}.hackathon-lineup-intro .hackathon-lineup-label,.hackathon-lineup-secondary .hackathon-lineup-label,.hackathon-lineup-final-label{font-size:16px}.hackathon-lineup-intro .hackathon-lineup-card,.hackathon-lineup-secondary .hackathon-lineup-card,.hackathon-lineup-final-card{grid-template-columns:135px minmax(0,1fr);min-height:92px;padding:13px 14px 13px 18px;border-radius:24px 0 34px 0}.hackathon-lineup-intro .hackathon-lineup-time,.hackathon-lineup-secondary .hackathon-lineup-time,.hackathon-lineup-final-time{font-size:24px}.hackathon-lineup-intro .hackathon-lineup-description,.hackathon-lineup-secondary .hackathon-lineup-description,.hackathon-lineup-final-description{padding-left:16px;font-size:14px}.hackathon-lineup-intro .hackathon-lineup-description h3,.hackathon-lineup-secondary .hackathon-lineup-description h3{font-size:14px}.hackathon-lineup-intro .hackathon-lineup-talks{font-size:18px}.hackathon-lineup-final-card{position:relative}.hackathon-lineup-final-description{padding:22px 0 0 16px}.hackathon-lineup-final-stage{position:absolute;top:-17px;left:50%;transform:translateX(-50%);max-width:calc(100% - 16px);min-height:38px;margin:0;padding:0 16px;font-size:15px;white-space:normal;text-align:center}.hackathon-closing-brand img{width:185px;height:210px}.hackathon-closing-brand p{font-size:22px}}
   @media(max-width:420px){.hackathon-lineup-intro .hackathon-lineup-card,.hackathon-lineup-secondary .hackathon-lineup-card,.hackathon-lineup-final-card{grid-template-columns:108px minmax(0,1fr);padding:9px}.hackathon-lineup-intro .hackathon-lineup-time,.hackathon-lineup-secondary .hackathon-lineup-time,.hackathon-lineup-final-time{font-size:20px}.hackathon-lineup-intro .hackathon-lineup-description,.hackathon-lineup-secondary .hackathon-lineup-description,.hackathon-lineup-intro .hackathon-lineup-description h3,.hackathon-lineup-secondary .hackathon-lineup-description h3{padding-left:9px;font-size:12px}.hackathon-lineup-final-description{padding:22px 0 0 9px;font-size:12px}.hackathon-lineup-final-stage{left:50%;min-height:32px;padding:0 10px;font-size:12px}.hackathon-closing-brand img{width:150px;height:175px}.hackathon-closing-brand p{font-size:18px}}
   </style>
   <style>
   .hackathon-people{padding-top:66px;padding-bottom:100px}.hackathon-people-container{max-width:1200px}.hackathon-mascot{top:-195px;width:290px}.hackathon-people-heading{margin-bottom:34px}.hackathon-people-heading span{font-size:16px}.hackathon-people-heading h2{font-size:42px}.hackathon-people-grid{max-width:1040px;column-gap:40px;row-gap:24px}.hackathon-person,.hackathon-person:nth-child(even){grid-template-columns:minmax(0,1fr) 140px;min-height:140px;gap:18px}.hackathon-person:nth-child(even){grid-template-columns:140px minmax(0,1fr)}.hackathon-person-copy{padding-bottom:10px}.hackathon-person-copy h3{font-size:16px}.hackathon-person-copy p{font-size:15px}.hackathon-person>img,.hackathon-person-placeholder{width:140px;height:140px}.hackathon-person-placeholder{font-size:34px}.hackathon-jury-heading{margin-top:82px}
   @media(max-width:767px){.hackathon-people{padding-top:50px;padding-bottom:68px}.hackathon-mascot{top:-140px;width:175px}.hackathon-people-heading span{font-size:14px}.hackathon-people-heading h2{font-size:34px}.hackathon-people-grid{max-width:540px;row-gap:18px}.hackathon-person,.hackathon-person:nth-child(even){grid-template-columns:minmax(0,1fr) 112px;min-height:112px;gap:16px}.hackathon-person:nth-child(even){grid-template-columns:minmax(0,1fr) 112px}.hackathon-person>img,.hackathon-person-placeholder{width:112px;height:112px}.hackathon-person-copy h3{font-size:14px}.hackathon-person-copy p{font-size:12px}.hackathon-jury-heading{margin-top:56px}}
   @media(max-width:420px){.hackathon-mascot{top:-112px;width:140px}.hackathon-people-heading h2{font-size:30px}.hackathon-person,.hackathon-person:nth-child(even){grid-template-columns:minmax(0,1fr) 96px;min-height:96px;gap:12px}.hackathon-person:nth-child(even){grid-template-columns:minmax(0,1fr) 96px}.hackathon-person>img,.hackathon-person-placeholder{width:96px;height:96px}.hackathon-person-copy h3{font-size:12px}.hackathon-person-copy p{font-size:11px}}
   </style>
