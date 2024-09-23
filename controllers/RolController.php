<?php

namespace Controllers;

use Exception;
use Model\Rol; 
use MVC\Router;

class RolController 
{
    public static function index(Router $router)
    {
        $roles = Rol::find(2); 
        $router->render('rol/index', [
            'roles' => $roles
        ]);
    }

    public static function buscarAPI()
    {
        try {
            $roles = Rol::obtenerRolesActivos(); 
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $roles
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar usuarios',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
