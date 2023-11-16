<?php

namespace Controllers;

use MVC\Router;

class InformesController {

    public static function index(Router $router) {
        $router->render('admin/informes/index', [
            'titulo' => 'Informes'
        ]);
    }
}