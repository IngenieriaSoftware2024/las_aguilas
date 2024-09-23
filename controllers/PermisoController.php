<?php

namespace Controllers;

use Exception;
use Model\Permiso; 
use MVC\Router;

class PermisoController 
{
    public static function index(Router $router)
    {
        $permisos = Permiso::find(2); 
        $router->render('permiso/index', [
            'permisos' => $permisos
        ]);
    }

    public static function datatable(Router $router)
    {
        $router->render('permiso/datatable', []);
    }

    public static function guardarAPI()
{
    // Verificar que 'usu_id' y 'rol_id' están presentes en la solicitud
    if (!isset($_POST['usu_id']) || !isset($_POST['rol_id'])) {
        http_response_code(400);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'Datos incompletos: Se requiere usu_id y rol_id',
        ]);
        return;
    }

    // Sanitizar los datos
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
        $_POST['per_usuario'] = htmlspecialchars($_POST['per_usuario']);
        $id = filter_var($_POST['per_id'], FILTER_SANITIZE_NUMBER_INT);
        try {
            $permiso = Permiso::find($id);
            $permiso->sincronizar($_POST);
            $permiso->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Permiso modificado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar permiso',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {
        $id = filter_var($_POST['per_id'], FILTER_SANITIZE_NUMBER_INT);
        try {
            $permiso = Permiso::find($id);
            $permiso->sincronizar([
                'per_situacion' => 0 
            ]);
            $permiso->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Permiso eliminado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar permiso',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
