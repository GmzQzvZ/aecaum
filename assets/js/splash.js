document.addEventListener('DOMContentLoaded', function () {
    const preloader = document.getElementById('preloader');
    
    // Solo inicializar si existe el preloader
    if (!preloader) return;

    // Si ya vio el splash en esta sesión de navegador, ocultarlo de inmediato
    if (sessionStorage.getItem('hasSeenSplash')) {
        preloader.style.display = 'none';
        return;
    }

    const hidePreloader = () => {
        sessionStorage.setItem('hasSeenSplash', 'true');
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

    // Efecto parallax con movimiento de la imagen de fondo
    const bgImage = preloader.querySelector('.preloader-bg img');
    
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

        // Mover la imagen de fondo en dirección opuesta al mouse
        const translateX = -moveX * 50;
        const translateY = -moveY * 50;

        bgImage.style.transform = `translate3d(${translateX}px, ${translateY}px, 0)`;
    });

    // Resetear cuando el mouse sale de la ventana
    document.addEventListener('mouseleave', () => {
        bgImage.style.transform = 'translate3d(0, 0, 0)';
    });
});
