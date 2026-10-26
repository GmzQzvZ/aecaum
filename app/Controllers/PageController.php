<?php
// ============================================================
// Controller: Page — Páginas públicas estáticas/semi-estáticas
// ============================================================

class PageController extends BaseController {

    /** Agenda institucional agrupada por mes. */
    public function agenda(): void {
        $years = \Agenda::years();
        $currentYear = (int) date('Y');
        if ($years === []) $years = [$currentYear];

        $requestedYear = (int) $this->query('year', (string) $years[0]);
        if (!in_array($requestedYear, $years, true)) $requestedYear = $years[0];

        $entries = \Agenda::all($requestedYear);
        $requestedMonth = (int) $this->query('month', '0');
        if ($requestedMonth < 1 || $requestedMonth > 12) {
            $currentMonth = (int) date('n');
            $requestedMonth = isset($entries[$currentMonth])
                ? $currentMonth
                : (int) (array_key_last($entries) ?: $currentMonth);
        }

        $this->render('pages/agenda', [
            'pageTitle'       => 'Agenda Institucional | AECAUM',
            'pageDescription' => 'Agenda mensual de la Asociación de Empresas de Correo de Argentina Última Milla.',
            'agendaEntries'   => $entries,
            'agendaYears'     => $years,
            'selectedYear'    => $requestedYear,
            'selectedMonth'   => $requestedMonth,
        ]);
    }

    public function about(): void {
        $this->render('pages/about', [
            'pageTitle'       => 'Nosotros - Quiénes Somos | AECAUM',
            'pageDescription' => 'Conocé la historia, misión, visión y estructura de AECAUM, la Asociación de Empresas de Correo de Argentina Última Milla.',
            'pageKeywords'    => 'nosotros aecaum, historia aecaum, empresas de correo argentina, asociacion postal argentina, mision vision aecaum',
        ]);
    }

    public function contact(): void {
        $sent  = false;
        $error = '';

        if ($this->isPost()) {
            error_log('Formulario POST recibido en contact()');
            error_log('Datos POST: ' . print_r($_POST, true));
            
            $name    = $this->input('name');
            $email   = $this->input('email');
            $message = $this->input('message');
            $fromHome = $this->input('from_home') === 'true';

            error_log("Nombre: $name, Email: $email, Message: " . substr($message, 0, 50));
            error_log("From home: " . ($fromHome ? 'yes' : 'no'));

            if (empty($name) || empty($email) || empty($message)) {
                $error = 'Por favor completá todos los campos requeridos.';
                error_log('Error: campos vacíos');
            } else {
                try {
                    $ok = Contact::create([
                        'name'    => $name,
                        'email'   => $email,
                        'message' => $message,
                    ]);
                    $sent = $ok;
                    error_log('Resultado Contact::create: ' . ($ok ? 'SUCCESS' : 'FAILED'));
                    if (!$ok) {
                        $error = 'Hubo un error al enviar el mensaje. Intentá nuevamente.';
                    }
                } catch (Exception $e) {
                    $error = 'Error: ' . $e->getMessage();
                    error_log('Excepción en Contact::create: ' . $e->getMessage());
                }
            }

            // Si la petición viene por AJAX, devolvemos JSON y no redirigimos
            $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['sent' => $sent, 'error' => $error]);
                return;
            }

            // Si viene desde home, redirigir a home con el mensaje
            if ($fromHome) {
                if ($sent) {
                    $this->redirect('?contact_sent=true');
                } else {
                    $this->redirect('?contact_error=' . urlencode($error));
                }
                return;
            }
        }

        $this->render('pages/contact', [
            'pageTitle'       => 'Contacto e Institucional | AECAUM',
            'pageDescription' => 'Ponete en contacto con AECAUM. Consultas institucionales, información para asociar tu empresa de correo o logística de última milla.',
            'pageKeywords'    => 'contacto aecaum, asociar empresa correo, soporte aecaum, formulario contacto logistica argentina',
            'sent'            => $sent,
            'error'           => $error,
        ]);
    }

    public function faq(): void {
        $this->render('pages/faq', [
            'pageTitle'       => 'Preguntas Frecuentes (FAQ) | AECAUM',
            'pageDescription' => 'Respuestas a las preguntas frecuentes sobre la Asociación de Empresas de Correo de Argentina Última Milla, regulación postal y membresías.',
            'pageKeywords'    => 'faq aecaum, preguntas frecuentes correo argentina, regulacion postal argentina, asociarse aecaum',
        ]);
    }

    public function hackathon(): void {
        $this->render('pages/hackathon', [
            'pageTitle'       => 'Hackathon de Innovación Postal | AECAUM',
            'pageDescription' => 'Iniciativas y Hackathon de tecnología e innovación en la logística postal y de última milla en Argentina.',
            'pageKeywords'    => 'hackathon aecaum, innovacion logistica, tecnologia postal, e-commerce logistica argentina',
        ]);
    }

    public function service(): void {
        $this->render('pages/service', [
            'pageTitle'       => 'Servicios e Iniciativas | AECAUM',
            'pageDescription' => 'Servicios, representación gremial e institucional, asesores y beneficios que brinda AECAUM a sus empresas asociadas.',
            'pageKeywords'    => 'servicios aecaum, beneficios socios aecaum, representacion institucional correo, asesoria postal argentina',
        ]);
    }

    public function serviceDetails(): void {
        $this->render('pages/service-details', [
            'pageTitle'       => 'Detalle de Servicios | AECAUM',
            'pageDescription' => 'Información detallada sobre las soluciones y acompañamiento institucional de AECAUM para la industria del correo.',
            'pageKeywords'    => 'detalle servicios aecaum, soporte postal argentina, ultima milla pymes',
        ]);
    }

    public function project(): void {
        $this->render('pages/project', [
            'pageTitle'       => 'Conciencia Sustentable y Proyectos | AECAUM',
            'pageDescription' => 'Proyectos de sustentabilidad, descarbonización y movilidad limpia en la distribución postal y de última milla en Argentina.',
            'pageKeywords'    => 'sustentabilidad logistica, movilidad sustentable aecaum, correo ecologico argentina, proyectos aecaum',
        ]);
    }

    public function projectDetails(): void {
        $this->render('pages/project-details', [
            'pageTitle'       => 'Detalle de Proyecto | AECAUM',
            'pageDescription' => 'Conocé los detalles y el impacto ambiental y social de los proyectos de AECAUM.',
            'pageKeywords'    => 'proyectos sustentables correo, impacto ambiental logistica, aecaum iniciativas',
        ]);
    }

    public function team(): void {
        $this->render('pages/team', [
            'pageTitle'       => 'Autoridades y Equipo Directivo | AECAUM',
            'pageDescription' => 'Conocé a las autoridades y miembros de la comisión directiva de AECAUM.',
            'pageKeywords'    => 'autoridades aecaum, comision directiva aecaum, lideres sector postal argentina',
        ]);
    }

    public function network(): void {
        $this->render('pages/network', [
            'pageTitle'       => 'Red de Empresas Socias | AECAUM',
            'pageDescription' => 'Nuestra red nacional de empresas privadas de correo y logística urbana en toda la República Argentina.',
            'pageKeywords'    => 'empresas asociadas aecaum, red de correo argentina, correos privados miembros, ultima milla argentina',
        ]);
    }

    public function blogList(): void {
        $this->render('pages/blog-list', [
            'pageTitle'       => 'Blog y Novedades del Sector Postal | AECAUM',
            'pageDescription' => 'Noticias, artículos técnicos, normativas y actualidad del sector del correo privado y logística e-commerce en Argentina.',
            'pageKeywords'    => 'blog aecaum, noticias correo argentina, actualidad logistica, novedades postales',
        ]);
    }

    public function blogDetails(): void {
        $this->render('pages/blog-details', [
            'pageTitle'       => 'Novedades y Noticias | AECAUM',
            'pageDescription' => 'Análisis y novedades institucionales sobre el desarrollo de la última milla en Argentina.',
            'pageKeywords'    => 'articulo aecaum, informe sectorial correo, logistica urbana',
            'hideNewsletter'  => true,
        ]);
    }

    public function indices(): void {
        $month = $this->query('month');
        $year = $this->query('year');
        $indices = \Index::all();

        // Filtrar por mes y año si se especifican
        if ($month || $year) {
            $indices = array_filter($indices, function($index) use ($month, $year) {
                $matchMonth = !$month || strtolower($index['month'] ?? '') === strtolower($month);
                $matchYear = !$year || (int)($index['year'] ?? 0) === (int)$year;
                return $matchMonth && $matchYear;
            });
            $indices = array_values($indices); // Reindexar array
        }

        $this->render('pages/indices', [
            'pageTitle'       => 'Índices de Costos Postales y Logística (IMC) | AECAUM',
            'pageDescription' => 'Consulta el Índice de Costos de Distribución Postal y Última Milla de AECAUM. Estadísticas oficiales y evolución de costos del sector.',
            'pageKeywords'    => 'indice costos correo argentina, imc aecaum, costos ultima milla, tarifa postal argentina, estadisticas correo',
            'indices'         => $indices,
            'month'           => $month,
            'year'            => $year,
        ]);
    }

    public function informesInstitucionales(): void {
        $informes = \Informe::all();
        $this->render('pages/informes-institucionales', [
            'pageTitle'       => 'Informes Institucionales y Reportes Sectoriales | AECAUM',
            'pageDescription' => 'Descargá informes institucionales, estudios del sector postal y publicaciones de AECAUM.',
            'pageKeywords'    => 'informes aecaum, reportes sector postal, estudios logistica argentina, publicaciones aecaum',
            'informes'        => $informes,
            'month'           => $this->query('month'),
            'year'            => $this->query('year'),
        ]);
    }

    /** Página de contenido institucional (secciones del menú) */
    public function content(string $slug): void {
        $pages = require APP_PATH . '/config/content_pages.php';

        if (!isset($pages[$slug])) {
            $this->notFound();
            return;
        }

        $page = $pages[$slug];
        $this->render('pages/content', [
            'pageTitle'          => $page['title'] . ' | AECAUM',
            'pageDescription'    => $page['description'] ?? 'Información institucional de la Asociación de Empresas de Correo de Argentina Última Milla.',
            'pageKeywords'       => 'aecaum, ' . strtolower($page['title']) . ', correo privado argentina',
            'sectionTitle'       => $page['title'],
            'sectionDescription' => $page['description'] ?? '',
            'breadcrumb'         => $page['breadcrumb'] ?? $page['title'],
        ]);
    }

    /** Página 404 */
    public function notFound(): void {
        http_response_code(404);
        $this->render('pages/404', [
            'pageTitle'       => 'Página No Encontrada (404) | AECAUM',
            'pageDescription' => 'La página que estás buscando no existe o ha sido movida.',
            'metaRobots'      => 'noindex, follow',
        ]);
    }
}
