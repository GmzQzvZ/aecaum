<?php
// ============================================================
// Controller: Home
// ============================================================

class HomeController extends BaseController {

    public function index(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $showSplash = false;
        if (!isset($_SESSION['has_seen_splash'])) {
            $showSplash = true;
            $_SESSION['has_seen_splash'] = true;
        }

        $this->render('pages/home', [
            'pageTitle'        => 'AECAUM | Inicio',
            'pageDescription'  => 'Asociación de Empresas de Correo de Argentina Última Milla. Unimos a las empresas líderes del sector postal y logístico.',
            'showSplash'       => $showSplash,
        ], 'main');
    }
}
