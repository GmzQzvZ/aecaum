document.addEventListener('DOMContentLoaded', function () {
    const preloader = document.getElementById('preloader');
    
    // Solo inicializar si existe el preloader (solo en home)
    if (!preloader) return;

    const hidePreloader = () => {
        if (!preloader.classList.contains('hidden')) {
            preloader.classList.add('hidden');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 600);
        }
    };

    // Configurar botón de descubrir
    const discoverBtn = preloader.querySelector('.preloader-btn .tv-btn-primary');
    if (discoverBtn) {
        discoverBtn.addEventListener('click', (e) => {
            e.preventDefault();
            hidePreloader();
        });
    }

    // Efecto parallax con movimiento opuesto al mouse
    const parallaxElements = preloader.querySelectorAll('[data-speed]');
    
    document.addEventListener('mousemove', (e) => {
        const mouseX = e.clientX;
        const mouseY = e.clientY;
        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;

        // Calcular punto central
        const centerX = windowWidth / 2;
        const centerY = windowHeight / 2;

        // Calcular distancia desde el centro (normalizado -1 a 1)
        const moveX = (mouseX - centerX) / centerX;
        const moveY = (mouseY - centerY) / centerY;

        parallaxElements.forEach((element) => {
            const speed = parseFloat(element.getAttribute('data-speed'));
            
            // Mover en dirección opuesta al movimiento del mouse
            const translateX = -moveX * speed * 100;
            const translateY = -moveY * speed * 100;

            element.style.transform = `translate3d(${translateX}px, ${translateY}px, 0)`;
        });
    });

    // Resetear cuando el mouse sale de la ventana
    document.addEventListener('mouseleave', () => {
        parallaxElements.forEach((element) => {
            element.style.transform = 'translate3d(0, 0, 0)';
        });
    });
});
