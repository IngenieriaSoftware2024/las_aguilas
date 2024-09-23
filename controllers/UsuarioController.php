<?php

namespace Controllers;

use Exception;
use Model\Usuario; 
use MVC\Router;

class UsuarioController 
{
    public static function index(Router $router)
    {
        isAuth();
        hasPermission(['ADMINISTRA']);
        $usuarios = Usuario::find(2); 
        $router->render('usuario/index', [
            'usuarios' => $usuarios
        ], 'layouts/menu');
    }

    public static function datatable(Router $router)
    {
        $router->render('usuario/datatable', []);
    }

    public static function guardarAPI()
    {
        $_POST['usu_nombre'] = htmlspecialchars($_POST['usu_nombre']);
        try {
            $password = password_hash($_POST['usu_password'], PASSWORD_BCRYPT);
            $usuario = new Usuario($_POST);
            $usuario->usu_password = $password;
            $usuario = $usuario->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Usuario guardado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar usuario',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        $_POST['usu_nombre'] = htmlspecialchars($_POST['usu_nombre']);
        try {
            $usuario = new Usuario($_POST);
            if (!empty($_POST['usu_password'])) {
                $usuario->usu_password = password_hash($_POST['usu_password'], PASSWORD_BCRYPT);
            }
            $usuario->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Usuario modificado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar usuario',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {
        try {
            $usuario = Usuario::find($_POST['usu_id']);
            $usuario->eliminar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Usuario eliminado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar usuario',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
    {
        try {
            $usuarios = Usuario::obtenerUsuariosConQuery(); // Obtiene solo los usuarios activos
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'datos' => $usuarios,
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