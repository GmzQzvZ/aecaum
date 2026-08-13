<?php
// ============================================================
// Controller: Home
// ============================================================

class HomeController extends BaseController {

    public function index(): void {
        $this->render('pages/home', [
            'pageTitle'        => 'AECAUM - Asociación de Empresas de Correo de Argentina Última Milla',
            'pageDescription'  => 'Asociación de Empresas de Correo de Argentina Última Milla (AECAUM). Representación institucional, índices de costos postales y soluciones de logística e-commerce en Argentina.',
            'pageKeywords'     => 'AECAUM, correo privado argentina, ultima milla, logistica e-commerce, asociacion de correos, indices postales, envios paquetes argentina',
            'showSplash'       => true,
        ], 'main');
    }
}
