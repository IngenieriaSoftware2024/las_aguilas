<?php

namespace Controllers;

use Exception;
use Model\Permiso;
use Model\Usuario;
use MVC\Router;

class LoginController
{

    public static function logout()
    {
        isAuth();
        $_SESSION = [];
        session_destroy();
        header('Location: /las_aguilas/');
    }

    public static function login(Router $router)
    {
        isNotAuth();
        $router->render('/login/login', []);
    }

    public static function loginAPI()
    {
        getHeadersApi();
        $_POST['usu_catalogo'] = filter_var($_POST['usu_catalogo'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['usu_password'] = trim(htmlspecialchars($_POST['usu_password']));
    
        try {
            $usuario = new Usuario($_POST);

            if ($usuario->validarUsuarioExistente()) {
                $usuarioBD = $usuario->usuarioExistente();
             
                //VALIDA QUE LA CONTRASEÑA ESTE CORRECTA
                if (password_verify($_POST['usu_password'], $usuarioBD['usu_password'])) {
                    
                    $_SESSION['user'] = $usuarioBD;
                    session_start();
                    
                    
                    $permisos = Permiso::fetchArray("SELECT * FROM permiso inner join rol on per_rol = rol_id where rol_situacion = 1 AND per_usuario = " . $usuarioBD['usu_id']);
                    
                    foreach ($permisos as $permiso) {
                        $_SESSION[$permiso['rol_nombre']] = 1;
                    }
       
                    http_response_code(200);
                    echo json_encode([
                        'codigo' => 1,
                        'mensaje' => 'Bienvenido al sistema, ' . $usuarioBD['usu_nombre'],
                    ]);
                    exit;
                } else {
                    http_response_code(404);
                    echo json_encode([
                        'codigo' => 0,
                        'mensaje' => 'La constraseña no coincide',
                        'detalle' => 'Verifique la contraseña ingresada',
                    ]);
                    exit;
                }
            } else {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'El usuario no existe',
                    'detalle' => 'No existe un usuario registrado con el catalogo proporcionado',
                ]);
                exit;
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al generar usuario',
                'detalle' => $e->getMessage(),
            ]);
            exit;
        }
        
    }


    public static function menu(Router $router)
    {
        isAuth();
        hasPermission(['AGENTE', 'ADMINISTRA', 'SUPERVISOR']);
        $router->render('inicio/bienvenida', [], 'layouts/menu');
    }
}