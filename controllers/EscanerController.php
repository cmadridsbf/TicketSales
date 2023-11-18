<?php

namespace Controllers;

use MVC\Router;

class EscanerController {

    public static function index(Router $router) {
        $router->render('admin/escaner/index', [
            'titulo' => 'Escáner'
        ]);
    }
}