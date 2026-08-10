<!doctype html>
<html class="no-js" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= htmlspecialchars($pageTitle ?? 'AECAUM - Asociación de Empresas de Correo de Argentina Última Milla') ?>
    </title>
    <meta name="description"
        content="<?= htmlspecialchars($pageDescription ?? 'AECAUM representa institucionalmente al sector de correos privados de la última milla en Argentina.') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= ASSETS_URL ?>/img/favicon.ico">

    <!-- CSS (rutas absolutas para que funcionen en cualquier sub-ruta) -->
    <?php
    function assetV(string $path): string
    {
        $full = $_SERVER['DOCUMENT_ROOT'] . '/aecaum/' . ltrim($path, '/');
        return file_exists($full) ? '?v=' . filemtime($full) : '?v=1';
    }
    ?>
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/slick.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/custom-animation.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/nice-select.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/swiper-bundle.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/font-awesome-pro.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/spacing.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/main.css<?= assetV('assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/splash.css">
</head>

<body id="body" class="tv-magic-cursor">
    <!-- Preloader (se muestra al ingresar o recargar; se oculta si se regresa desde otra subpágina) -->
    <?php if ($showSplash ?? false): ?>
        <script>
            (function () {
                var isReload = false;
                try {
                    var nav = performance.getEntriesByType("navigation");
                    if (nav.length > 0 && nav[0].type === "reload") {
                        isReload = true;
                    }
                } catch (e) { }

                var ref = document.referrer;
                var isInternalNavigation = false;
                if (ref && ref.indexOf(window.location.host) !== -1) {
                    try {
                        var refPath = new URL(ref).pathname.replace(/\/$/, "");
                        var currPath = window.location.pathname.replace(/\/$/, "");
                        if (refPath !== currPath) {
                            isInternalNavigation = true;
                        }
                    } catch (e) {
                        isInternalNavigation = true;
                    }
                }

                if (isInternalNavigation && !isReload) {
                    document.write('<style>#preloader{display:none!important;}</style>');
                }
            })();
        </script>
        <div id="preloader">
            <div class="preloader-container">
                <!-- Background buildings -->
                <div class="preloader-bg">
                    <img loading="lazy" src="assets/img/icon/intro2.png" alt="currier">
                </div>

                <!-- Content -->
                <div class="preloader-content" data-speed="0.03">
                    <div class="preloader-logo">
                        <img loading="lazy" src="assets/img/logo/AECAUM PORTADA.png" alt="AECAUM">

                        <div class="preloader-btn" data-speed="0.05">
                            <a href="<?= BASE_URL ?>/" class="tv-btn-primary">
                                <span class="btn-wrap">
                                    <span class="btn-text1">Descubrí</span>
                                    <span class="btn-text2">Descubrí</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Magic cursor -->
    <div id="magic-cursor">
        <div id="ball"></div>
    </div>

    <!-- Back to top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="ti ti-arrow-up"></i>
    </button>

    <!-- Search popup -->
    <div class="search__popup">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="search__wrapper">
                        <div class="search__top d-flex justify-content-between align-items-center">
                            <div class="search__logo">
                                <a href="<?= BASE_URL ?>/">
                                    <img loading="lazy" src="<?= ASSETS_URL ?>/img/logo/logo-white.png" alt="AECAUM">
                                </a>
                            </div>
                            <div class="search__close">
                                <button type="button" class="search__close-btn search-close-btn">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="search__form">
                            <form action="#">
                                <div class="search__input">
                                    <input class="search-input-field" type="text" placeholder="Buscar...">
                                    <span class="search-focus-border"></span>
                                    <button type="submit">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <?php include __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Contenido de la página -->
    <main>
        <?php echo $content ?? ''; ?>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/../partials/footer.php'; ?>

    <!-- JS (rutas absolutas) -->
    <script src="<?= ASSETS_URL ?>/js/jquery.js"></script>
    <script src="<?= ASSETS_URL ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ASSETS_URL ?>/js/slick.min.js"></script>
    <script src="<?= ASSETS_URL ?>/js/magnific-popup.js"></script>
    <script src="<?= ASSETS_URL ?>/js/purecounter.js"></script>
    <script src="<?= ASSETS_URL ?>/js/wow.js"></script>
    <script src="<?= ASSETS_URL ?>/js/nice-select.js"></script>
    <script src="<?= ASSETS_URL ?>/js/range-slider.js"></script>
    <script src="<?= ASSETS_URL ?>/js/swiper-bundle.js"></script>
    <script src="<?= ASSETS_URL ?>/js/isotope-pkgd.js"></script>
    <script src="<?= ASSETS_URL ?>/js/imagesloaded-pkgd.js"></script>
    <script src="<?= ASSETS_URL ?>/js/main-tv.js"></script>
    <script src="<?= ASSETS_URL ?>/js/custom-gsap.js"></script>
    <script src="<?= ASSETS_URL ?>/js/slider.js"></script>
    <script src="<?= ASSETS_URL ?>/js/main.js<?= assetV('assets/js/main.js') ?>"></script>
    <script src="<?= ASSETS_URL ?>/js/splash.js<?= assetV('assets/js/splash.js') ?>"></script>

    <script>
        // Mouse parallax suave para el fondo del preloader
        (function () {
            let targetX = 0, targetY = 0;
            let currentX = 0, currentY = 0;
            let rafId = null;
            const ease = 0.06;

            document.addEventListener("mousemove", (e) => {
                targetX = (e.clientX - window.innerWidth / 2) * 0.03;
                targetY = (e.clientY - window.innerHeight / 2) * 0.03;
            });

            function animate() {
                const preloader = document.getElementById("preloader");
                // Detener el loop si el preloader ya está oculto
                if (!preloader || preloader.classList.contains("hidden")) return;

                const img = preloader.querySelector(".preloader-bg img");
                if (img) {
                    currentX += (targetX - currentX) * ease;
                    currentY += (targetY - currentY) * ease;
                    img.style.transform = `translate(${currentX}px, ${currentY}px) scale(1.05)`;
                }
                rafId = requestAnimationFrame(animate);
            }
            animate();
        })();
    </script>

</body>

</html>