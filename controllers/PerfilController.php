<?php

namespace Controllers;

use Exception;
use Model\Usuario;
use Model\Permiso;
use MVC\Router;

class PerfilController 
{
    public static function index(Router $router)
    {
        // Obtener ambos, usuarios y permisos
        $usuarios = Usuario::obtenerUsuariosConQuery(); // Llamar al método estático
        $permisos = Permiso::obtenerPermisosConQuery(); // Llamar al método estático

        // Renderizar la vista única
        $router->render('perfil/gestionar', [
            'usuarios' => $usuarios,
            'permisos' => $permisos,
        ]);
    }

    public static function guardarAPI()
    {
        // Sanitización de entradas
        $_POST['usu_nombre'] = htmlspecialchars($_POST['usu_nombre']);
        $_POST['per_nombre'] = htmlspecialchars($_POST['per_nombre']);
    
        try {
            // Crear el usuario
            $usuario = new Usuario($_POST); // Instanciar correctamente
            $resultadoUsuario = $usuario->crear();
    
            if ($resultadoUsuario) {
                // Crear el permiso para el usuario recién creado
                $permiso = new Permiso([
                    'per_usuario' => $usuario->usu_id,
                    'per_rol' => $_POST['per_rol'],
                    'per_situacion' => 1
                ]);
                $resultadoPermiso = $permiso->crear();
    
                if ($resultadoPermiso) {
                    http_response_code(200);
                    echo json_encode([
                        'codigo' => 1,
                        'mensaje' => 'Usuario y permiso guardados exitosamente',
                    ]);
                } else {
                    throw new Exception("Error al guardar el permiso.");
                }
            } else {
                throw new Exception("Error al guardar el usuario.");
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al procesar la solicitud',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
    {
        try {
            $usuarios = Usuario::obtenerUsuariosConQuery(); // Usar el método del modelo
            $permisos = Permiso::obtenerPermisosConQuery(); // Usar el método del modelo

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'datos' => [
                    'usuarios' => $usuarios,
                    'permisos' => $permisos,
                ]
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar usuarios o permisos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        $_POST['usu_nombre'] = htmlspecialchars($_POST['usu_nombre']);
        $_POST['per_rol'] = htmlspecialchars($_POST['per_rol']);
        $tipo = $_POST['tipo'] ?? '';
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            if ($tipo === 'usuario') {
                $usuario = Usuario::find($id); // Usar el método find del modelo
                $usuario->sincronizar($_POST);
                $usuario->actualizar();
                http_response_code(200);
                echo json_encode(['codigo' => 1, 'mensaje' => 'Usuario modificado exitosamente']);
            } elseif ($tipo === 'permiso') {
                $permiso = Permiso::find($id); // Usar el método find del modelo
                $permiso->sincronizar($_POST);
                $permiso->actualizar();
                http_response_code(200);
                echo json_encode(['codigo' => 1, 'mensaje' => 'Permiso modificado exitosamente']);
            } else {
                http_response_code(400);
                echo json_encode(['codigo' => 0, 'mensaje' => 'Tipo de entidad no válida']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['codigo' => 0, 'mensaje' => 'Error al modificar la entidad', 'detalle' => $e->getMessage()]);
        }
    }

    public static function eliminarAPI()
    {
        $tipo = $_POST['tipo'] ?? '';
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

        if (!in_array($tipo, ['usuario', 'permiso'])) {
            http_response_code(400);
            echo json_encode(['codigo' => 0, 'mensaje' => 'Tipo de entidad no válida']);
            return;
        }

        try {
            if ($tipo === 'usuario') {
                $usuario = Usuario::find($id); // Usar el método find del modelo
                $usuario->sincronizar(['usu_situacion' => 0]);
                $usuario->actualizar();
                http_response_code(200);
                echo json_encode(['codigo' => 1, 'mensaje' => 'Usuario eliminado exitosamente']);
            } elseif ($tipo === 'permiso') {
                $permiso = Permiso::find($id); // Usar el método find del modelo
                $permiso->sincronizar(['per_situacion' => 0]);
                $permiso->actualizar();
                http_response_code(200);
                echo json_encode(['codigo' => 1, 'mensaje' => 'Permiso eliminado exitosamente']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['codigo' => 0, 'mensaje' => 'Error al eliminar la entidad', 'detalle' => $e->getMessage()]);
        }
    }
}
