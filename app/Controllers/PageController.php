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
            $name    = $this->input('name');
            $email   = $this->input('email');
            $subject = $this->input('subject');
            $message = $this->input('message');

            if (empty($name) || empty($email) || empty($message)) {
                $error = 'Por favor completá todos los campos requeridos.';
            } else {
                // TODO: Integrar envío de email real (PHPMailer o similar)
                $sent = true;
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
