<?php

namespace Controllers;

use Exception;
use Model\Permiso; 
use MVC\Router;

class PermisoController 
{
    public static function index(Router $router)
    {
        isAuth();
        hasPermission(['ADMINISTRA']);
        $permisos = Permiso::find(2);

        $router->render('permiso/index', [
            'permisos' => $permisos
        ], 'layouts/menu');
    }

    public static function datatable(Router $router)
    {
        $router->render('permiso/datatable', []);
    }

    public static function guardarAPI()
{
    
    if (!isset($_POST['usu_id']) || !isset($_POST['rol_id'])) {
        http_response_code(400);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'Datos incompletos: Se requiere usu_id y rol_id',
        ]);
        return;
    }

    
    $_POST['usu_id'] = htmlspecialchars($_POST['usu_id']);
    $_POST['rol_id'] = htmlspecialchars($_POST['rol_id']);

    try {
        $permiso = new Permiso($_POST);
        $permiso->crear();
        http_response_code(200);
        echo json_encode([
            'codigo' => 1,
            'mensaje' => 'Permiso guardado exitosamente',
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'Error al guardar permiso',
            'detalle' => $e->getMessage(),
        ]);
    }
}

    public static function buscarAPI()
    {
        try {
            $permisos = Permiso::obtenerPermisosConQuery(); 
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $permisos
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar permisos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        if (!isset($_POST['per_id']) || !isset($_POST['usu_id']) || !isset($_POST['rol_id'])) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Datos incompletos: Se requiere per_id, usu_id y rol_id',
            ]);
            return;
        }
    
        $_POST['usu_id'] = htmlspecialchars($_POST['usu_id']);
        $_POST['rol_id'] = htmlspecialchars($_POST['rol_id']);
        $_POST['per_id'] = htmlspecialchars($_POST['per_id']); 
    
        try {
            $permiso = new Permiso($_POST);
            $permiso->actualizar(); 
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Permiso modificado con éxito',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar el permiso: ' . $e->getMessage(),
            ]);
        }
    }
    

    public static function eliminarAPI()
{
    if (!isset($_POST['per_id'])) {
        http_response_code(400);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'Datos incompletos: Se requiere per_id',
        ]);
        return;
    }

    $_POST['per_id'] = htmlspecialchars($_POST['per_id']); 

    try {
        $permiso = Permiso::find($_POST['per_id']); 
        if (!$permiso) {
            throw new Exception('Permiso no encontrado');
        }
        $permiso->eliminar(); 
        http_response_code(200);
        echo json_encode([
            'codigo' => 1,
            'mensaje' => 'Permiso eliminado con éxito',
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'Error al eliminar el permiso: ' . $e->getMessage(),
        ]);
    }
}

}
