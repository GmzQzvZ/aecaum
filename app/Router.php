<?php
// ============================================================
// Router — Enrutador central de la aplicación
// ============================================================

class Router {

    /** @var array<string, array{controller: string, action: string, methods: string[]}> */
    private array $routes = [];

    public function __construct() {
        $this->registerRoutes();
    }

    private function registerRoutes(): void {
        // --- Home ---
        $this->get('',              HomeController::class,    'index');
        $this->get('home',          HomeController::class,    'index');

        // --- Autenticación ---
        $this->match('GET|POST', 'login',            AuthController::class, 'login');
        $this->get('logout',                          AuthController::class, 'logout');
        $this->match('GET|POST', 'recuperar-clave',   AuthController::class, 'forgotPassword');
        $this->match('GET|POST', 'forgot-password',    AuthController::class, 'forgotPassword');
        $this->match('GET|POST', 'reset-password',     AuthController::class, 'resetPassword');
        $this->match('GET|POST', 'reset-clave',        AuthController::class, 'resetPassword');

        // --- Panel de usuario ---
        $this->get('dashboard',                       DashboardController::class, 'index');

        // --- Índices públicos ---
        $this->get('indices',                         PageController::class, 'indices');
        $this->get('indices/imc',                     PageController::class, 'indices');
        $this->get('indices/informes-institucionales', PageController::class, 'indices');

        // --- Panel de administración ---
        $this->match('GET|POST', 'admin',             AdminController::class, 'index');
        $this->match('GET|POST', 'admin/usuarios',    AdminController::class, 'users');
        $this->match('GET|POST', 'admin/roles',       AdminController::class, 'roles');
        $this->match('GET|POST', 'admin/documentos',  AdminController::class, 'documents');
        $this->match('GET|POST', 'admin/indices',     AdminController::class, 'indices');
        $this->match('GET|POST', 'admin/contacto',    AdminController::class, 'contactMessages');

        // --- Páginas públicas ---
        $this->match('GET|POST', 'about',             PageController::class, 'about');
        $this->match('GET|POST', 'nosotros',          PageController::class, 'about');
        $this->match('GET|POST', 'contact',           PageController::class, 'contact');
        $this->match('GET|POST', 'contacto',          PageController::class, 'contact');
        $this->get('faq',                             PageController::class, 'faq');
        $this->get('network',                         PageController::class, 'network');
        $this->get('service',                         PageController::class, 'service');
        $this->get('service-details',                 PageController::class, 'serviceDetails');
        $this->get('project',                         PageController::class, 'project');
        $this->get('proyectos',                       PageController::class, 'project');
        $this->get('project-details',                 PageController::class, 'projectDetails');
        $this->get('team',                            PageController::class, 'team');
        $this->get('blog',                            PageController::class, 'blogList');
        $this->get('blog-details',                    PageController::class, 'blogDetails');

        // --- Secciones institucionales (contenido dinámico) ---
        $contentPages = require APP_PATH . '/config/content_pages.php';
        foreach (array_keys($contentPages) as $slug) {
            $this->get($slug, PageController::class, 'content');
        }
    }

    private function get(string $path, string $controller, string $action): void {
        $this->addRoute($path, $controller, $action, ['GET']);
    }

    private function match(string $methods, string $path, string $controller, string $action): void {
        $this->addRoute($path, $controller, $action, explode('|', $methods));
    }

    private function addRoute(string $path, string $controller, string $action, array $methods): void {
        $this->routes[$path] = [
            'controller' => $controller,
            'action'     => $action,
            'methods'    => $methods,
        ];
    }

    /**
     * Resuelve la URI y despacha al controlador correspondiente.
     */
    public function dispatch(string $uri, string $method): void {
        $path = trim(parse_url($uri, PHP_URL_PATH) ?? '', '/');

        // Quitar el prefijo base del proyecto (ej: aecaum/login → login)
        $base = trim(BASE_PATH, '/');
        if ($base !== '' && str_starts_with($path, $base)) {
            $path = trim(substr($path, strlen($base)), '/');
        }

        $route = $this->routes[$path] ?? null;

        if ($route && in_array($method, $route['methods'], true)) {
            $controller = new $route['controller']();
            $action     = $route['action'];

            // Pasar el slug a content() para páginas institucionales
            if ($action === 'content') {
                $controller->$action($path);
                return;
            }

            $controller->$action();
            return;
        }

        // 404
        $controller = new PageController();
        $controller->notFound();
    }
}
