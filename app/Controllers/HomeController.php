<?php
// ============================================================
// Controller: Home
// ============================================================

class HomeController extends BaseController {

    public function index(): void {
        $this->render('pages/home', [
            'pageTitle'        => 'AECAUM | Inicio',
            'pageDescription'  => 'Asociación de Empresas de Correo de Argentina Última Milla. Unimos a las empresas líderes del sector postal y logístico.',
            'showSplash'       => true,
        ], 'main');
    }
}
