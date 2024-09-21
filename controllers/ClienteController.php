<?php

namespace Controllers;

use MVC\Router;

class ClienteController
{
    public static function index(Router $router) {
        $router->render('clientes/cliente', []);
    }

    public static function guardarAPI(){
        echo $_POST;
        return;
    }
}
