<?php
// ============================================================
// Controller: Page — Páginas públicas estáticas/semi-estáticas
// ============================================================

class PageController extends BaseController {

    public function about(): void {
        $this->render('pages/about', [
            'pageTitle'       => 'Nosotros | AECAUM',
            'pageDescription' => 'Conocé la historia, misión y visión de la Asociación de Empresas de Correo de Argentina Última Milla.',
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
            'pageTitle' => 'Contacto | AECAUM',
            'sent'      => $sent,
            'error'     => $error,
        ]);
    }

    public function faq(): void {
        $this->render('pages/faq', [
            'pageTitle' => 'Preguntas Frecuentes | AECAUM',
        ]);
    }

    public function service(): void {
        $this->render('pages/service', [
            'pageTitle' => 'Servicios | AECAUM',
        ]);
    }

    public function serviceDetails(): void {
        $this->render('pages/service-details', [
            'pageTitle' => 'Detalle de Servicio | AECAUM',
        ]);
    }

    public function project(): void {
        $this->render('pages/project', [
            'pageTitle' => 'Conciencia Sustentable | AECAUM',
        ]);
    }

    public function projectDetails(): void {
        $this->render('pages/project-details', [
            'pageTitle' => 'Detalle de Proyecto | AECAUM',
        ]);
    }

    public function team(): void {
        $this->render('pages/team', [
            'pageTitle' => 'Equipo | AECAUM',
        ]);
    }

    public function network(): void {
        $this->render('pages/network', [
            'pageTitle' => 'Red de Socios | AECAUM',
        ]);
    }

    public function blogList(): void {
        $this->render('pages/blog-list', [
            'pageTitle' => 'Blog y Novedades | AECAUM',
        ]);
    }

    public function blogDetails(): void {
        $this->render('pages/blog-details', [
            'pageTitle' => 'Artículo | AECAUM',
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
            'pageTitle' => 'Índices | AECAUM',
            'indices'   => $indices,
            'month'     => $month,
            'year'      => $year,
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
            'pageDescription'    => $page['description'] ?? '',
            'sectionTitle'       => $page['title'],
            'sectionDescription' => $page['description'] ?? '',
            'breadcrumb'         => $page['breadcrumb'] ?? $page['title'],
        ]);
    }

    /** Página 404 */
    public function notFound(): void {
        http_response_code(404);
        $this->render('pages/404', [
            'pageTitle' => 'Página no encontrada | AECAUM',
        ]);
    }
}
