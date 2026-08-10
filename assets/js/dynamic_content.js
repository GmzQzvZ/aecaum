
function updateContent(id) {
  const contentMap = {
    course1: {
      src: "assets/img/project/logistica.png",
      alt: "Logística Internacional, Digital Commerce y Cross-Border",
      html: `
        <span class="tv-section-subtitle tv-spltv-text tv-spltv-in-right">Modalidad Online</span>
        <h1 class="tv-section-title" style="font-size: 30px;"><strong>Logística Internacional, </strong><br> <strong style="font-size:38px;">Digital Commerce y Cross-Border</strong></h1>
        <p>El comercio digital transfronterizo es un pilar estratégico para las empresas que buscan expandirse y competir en un entorno globalizado. La digitalización ha transformado la forma en que operan los negocios, y comprender sus dinámicas es clave para maximizar oportunidades y minimizar riesgos. Este trayecto de formación proporciona conocimientos fundamentales sobre los principales ejes del comercio internacional, la logística global y la cadena de aprovisionamiento. Los participantes adquirirán una visión integral de aspectos esenciales como la secuencia de compraventa internacional, Incoterms, medios de pago, transporte, clasificación y valoración de mercancías.</p>
        <p>Además, se abordará la gestión del relacionamiento con organismos de control y comercio, junto con el marco normativo vigente, brindando herramientas para su actualización continua. Con un enfoque práctico y actualizado, esta formación permitirá a los profesionales del sector optimizar estrategias, mejorar la eficiencia operativa y adaptarse con éxito a las demandas del comercio digital sin fronteras.</p>
      `
    },
    course2: {
      src: "assets/img/project/fulltime.jpeg",
      alt: "Fulfillment para Negocios Multicanales",
      html: `
        <span class="tv-section-subtitle tv-spltv-text tv-spltv-in-right">Modalidad Online</span>
        <h1 class="tv-section-title"><strong>Fulfillment<br> para Negocios Multicanales</strong></h1>
        <p>El <strong>fulfillment</strong> es un proceso clave para las empresas que operan en múltiples canales de venta <strong>B2C (Business-to-Consumer)</strong>, como tiendas en línea, marketplaces, ventas físicas y otros puntos de contacto. La correcta ejecución de una operación de fulfillment no solo mejora la eficiencia de la cadena de suministro, sino que también afecta directamente la experiencia del cliente y la rentabilidad de la empresa.</p>
        <p>Este curso detalla los aspectos fundamentales para montar una operación de fulfillment, desde la definición de procesos, layout de almacén, equipo de trabajo, tecnología e integraciones entre sistemas, entre otros aspectos fundamentales.</p>
      `
    },
    course3: {
      src: "assets/img/project/ultima milla.jpeg",
      alt: "Gestión de la Última Milla: Tecnologías de Vanguardia",
      html: `
        <span class="tv-section-subtitle tv-spltv-text tv-spltv-in-right">Modalidad Online</span>
        <h1 class="tv-section-title" style="font-size:30px;"><strong>Gestión de la Última Milla:</strong><br><strong style="font-size:38px;">Modelos y Tecnologías de Vanguardia</strong></h1>
        <p>En la era de la globalización y el auge del comercio electrónico, la gestión eficiente de la última milla se ha convertido en un elemento crítico para el <strong>éxito de las empresas de distribución y mensajería.</strong> Compañías líderes como Amazon han revolucionado las expectativas de los consumidores en cuanto a velocidad, flexibilidad y transparencia en las entregas. Al mismo tiempo, las empresas de mensajería tradicionales enfrentan el desafío de adaptarse a un entorno cada vez más competitivo y tecnológicamente avanzado.</p>
        <p>Este curso propone un espacio de análisis y discusión sobre los modelos y tecnologías más actuales en la gestión de la última milla. Se explorarán las estrategias implementadas por empresas líderes, se analizarán las tendencias tecnológicas y se debatirá sobre las mejores prácticas para optimizar las operaciones logísticas, reducir costos y mejorar la satisfacción del cliente.</p>
      `
    },
    course4: {
      src: "assets/img/project/ecommerce.jpeg",
      alt: "Introducción al eCommerce",
      html: `
        <span class="tv-section-subtitle tv-spltv-text tv-spltv-in-right">Modalidad Online</span>
        <h1 class="tv-section-title"><strong>Introducción al eCommerce</strong></h1>
        <p>El comercio electrónico, conocido como <strong>eCommerce</strong>, ha transformado la forma en que las empresas y consumidores interactúan en el mercado global. Desde su origen, el eCommerce ha crecido exponencialmente, ofreciendo una alternativa eficiente y accesible al comercio tradicional. Este curso proporcionará una comprensión profunda de los fundamentos del eCommerce, así como de las estrategias de marketing digital, seguridad en transacciones electrónicas y legislación aplicable. La Universidad Nacional de Delta ofrece este curso para responder a la creciente demanda de profesionales que puedan gestionar y optimizar plataformas de comercio electrónico.</p>
        <p>A través de un enfoque teórico y práctico, este curso capacitará a los estudiantes para crear, gestionar y optimizar tiendas online, aplicando estrategias de marketing y garantizando la seguridad en las transacciones y protección de datos.</p>
      `
    },
    course5: {
      src: "assets/img/project/tecnologia.jpeg",
      alt: "Tecnología en Logística, Automatizaciones y Actualidad",
      html: `
        <span class="tv-section-subtitle tv-spltv-text tv-spltv-in-right">Modalidad Online</span>
        <h1 class="tv-section-title"><strong>Tecnología en Logística,<br> Automatizaciones y Actualidad</strong></h1>
        <p>Este curso explorará las <strong>innovaciones tecnológicas</strong> actuales en el campo de la logística, cómo estas automatizaciones están transformando la industria y qué tendencias se vislumbran para el futuro próximo. La transformación digital ha impactado profundamente en todos los sectores económicos, y la logística no es la excepción. La necesidad de operaciones más eficientes, rápidas y seguras ha impulsado la adopción de tecnologías como la inteligencia artificial, el Internet de las Cosas (IoT), la robótica y el análisis de datos. Estas herramientas permiten optimizar rutas de distribución, gestionar inventarios en tiempo real, mejorar la trazabilidad de productos y reducir costos operativos.</p>
        <p>Es fundamental que los profesionales de logística comprendan estas tendencias para mantenerse relevantes en el mercado laboral y contribuir al desarrollo de soluciones innovadoras.</p>
      `
    },
    course6: {
      src: "assets/img/project/integracion.jpeg",
      alt: "Integración y Diseño de Procesos",
      html: `
        <span class="tv-section-subtitle tv-spltv-text tv-spltv-in-right">Modalidad Online</span>
        <h1 class="tv-section-title"><strong>Integración<br>y Diseño de Procesos</strong></h1>
        <p>La integración y diseño de procesos son esenciales para asegurar la <strong>correcta organización y ejecución de proyectos,</strong> permitiendo que cada fase contribuya eficazmente al logro de los objetivos planteados. Este curso ofrece una introducción exhaustiva a los principios de gestión de procesos, brindando las herramientas y conocimientos necesarios para identificar, diseñar e implementar procesos que optimicen los resultados de cualquier proyecto.</p>
        <p>Con un enfoque teórico y práctico, se exploran temas que van desde la definición y fases de gestión de procesos hasta el diseño de diagramas y su aplicación práctica en diversos contextos empresariales.</p>
        <p>A lo largo de este programa, se aprenderá a gestionar los procesos en cada etapa del proyecto, aplicar técnicas de diseño y mejora continua, y alinear los procesos con los objetivos estratégicos de la organización.</p>
      `
    },
    course7: {
      src: "assets/img/project/inteligencia.jpeg",
      alt: "Inteligencia Artificial y Optimización de Procesos",
      html: `
        <span class="tv-section-subtitle tv-spltv-text tv-spltv-in-right">Modalidad Online</span>
        <h1 class="tv-section-title"><strong>Inteligencia Artificial <br>y Optimización de Procesos</strong></h1>
        <p>Este curso introduce los principales conceptos y aplicaciones de la <strong>Inteligencia Artificial aplicada a la logística,</strong> orientados a la optimización de procesos, la eficiencia operativa y la toma de decisiones basada en datos.</p>
        <p>A lo largo del trayecto, se abordarán herramientas y enfoques que permiten mejorar la planificación, el ruteo, la gestión de recursos y la performance de la última milla. El curso ofrece una visión estratégica sobre cómo integrar soluciones de IA en operaciones logísticas reales, potenciando la competitividad y la innovación en el sector.</p>
      `
    },
    course8: {
      src: "assets/img/project/estudio.jpeg",
      alt: "Estudio e Investigación de Casos Logísticos",
      html: `
        <span class="tv-section-subtitle tv-spltv-text tv-spltv-in-right">Modalidad Online</span>
        <h1 class="tv-section-title"><strong>Estudio e Investigación <br> de Casos Logísticos</strong></h1>
        <p>Este curso propone el análisis de casos reales del sector logístico, con especial foco en la última milla y el comercio electrónico, como herramienta central para la toma de decisiones. A partir del estudio de experiencias concretas, los participantes desarrollarán una mirada crítica sobre modelos operativos, estrategias implementadas y resultados obtenidos.</p>
        <p>El espacio busca fortalecer la capacidad de análisis, interpretación y evaluación de escenarios reales, integrando conocimientos teóricos con situaciones prácticas del sector. De este modo, el estudio de casos se convierte en un puente entre la formación académica y los desafíos cotidianos de la gestión logística.</p>
      `
    }
  };

  const imgEl = document.getElementById("dynamicImage");
  const contentEl = document.getElementById("dynamicContent");
  if (!imgEl || !contentEl) {
    console.warn("updateContent: Required DOM elements not found.");
    return;
  }

  const entry = contentMap[id];
  if (!entry) {
    console.warn(`updateContent: No entry for id ${id}`);
    return;
  }

  imgEl.src = entry.src;
  imgEl.alt = entry.alt;
  contentEl.innerHTML = entry.html;
  setActiveCategory(id);
}

window.updateContent = updateContent;

function setActiveCategory(id) {
  document.querySelectorAll('.cat-item').forEach(item => {
    const link = item.querySelector('a[data-course-id]');
    item.classList.toggle('active', link && link.dataset.courseId === id);
  });
}

function bindButtons(className = "content-switch") {
  document.querySelectorAll(`button.${className}`).forEach(btn => {
    btn.addEventListener("click", () => {
      const id = btn.dataset.targetId;
      if (id) updateContent(id);
    });
  });
}

document.addEventListener("DOMContentLoaded", () => {
  bindButtons();
  const stored = (function(){ try { return localStorage.getItem('selectedCourse'); } catch(e){ return null; } })();
  if (stored) {
    updateContent(stored);
    try { localStorage.removeItem('selectedCourse'); } catch(e){}
  } else {
    updateContent('course2');
  }
});
