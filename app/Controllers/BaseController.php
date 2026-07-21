<?php
// ============================================================
// Base Controller — Clase base para todos los controladores
// ============================================================

class BaseController {

    /**
     * Renderiza una vista dentro de un layout.
     * El array $data se expone como variables locales en la vista y el layout.
     *
     * @param string $view   Ruta relativa a app/Views/ (sin .php)
     * @param array  $data   Variables que estarán disponibles en la vista
     * @param string $layout Nombre del layout en app/Views/layouts/ (sin .php)
     */
    public function render(string $view, array $data = [], string $layout = 'main'): void {
        // Expone variables del array en el scope local
        extract($data, EXTR_SKIP);

        // Captura el contenido de la vista
        ob_start();
        $viewFile = VIEWS_PATH . '/' . $view . '.php';
        if (!file_exists($viewFile)) {
            ob_end_clean();
            http_response_code(500);
            die('<p style="font-family:sans-serif;padding:40px;">Vista no encontrada: <code>' . htmlspecialchars($viewFile) . '</code></p>');
        }
        include $viewFile;
        $content = ob_get_clean();

        // Renderiza el layout con $content disponible
        $layoutFile = LAYOUTS_PATH . '/' . $layout . '.php';
        if (!file_exists($layoutFile)) {
            echo $content;
            return;
        }

        // Re-expone $data para el layout (necesita $pageTitle, etc.)
        extract($data, EXTR_SKIP);
        include $layoutFile;
    }

    /**
     * Redirige a una URL relativa a APP_URL.
     * Ej: redirect('admin/usuarios') → http://localhost/ACAEUM/admin/usuarios
     */
    protected function redirect(string $path = ''): void {
        header('Location: ' . APP_URL . '/' . ltrim($path, '/'));
        exit;
    }

    /**
     * Responde con JSON.
     */
    protected function json(array $data, int $status = 200): void {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Retorna true si el método HTTP es POST.
     */
    protected function isPost(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Obtiene y sanitiza un campo del POST.
     */
    protected function input(string $key, string $default = ''): string {
        return isset($_POST[$key]) ? trim(htmlspecialchars($_POST[$key], ENT_QUOTES, 'UTF-8')) : $default;
    }

    /**
     * Obtiene un parámetro GET sanitizado.
     */
    protected function query(string $key, string $default = ''): string {
        return isset($_GET[$key]) ? trim(htmlspecialchars($_GET[$key], ENT_QUOTES, 'UTF-8')) : $default;
    }
}
