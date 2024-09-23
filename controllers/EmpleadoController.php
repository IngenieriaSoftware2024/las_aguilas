<?php

namespace Controllers;

use Exception;
use Model\Empleado; 
use MVC\Router;

class EmpleadoController 
{
    public static function index(Router $router)
    {
        $empleados = Empleado::find(2); 
        $router->render('empleado/index', [
            'empleados' => $empleados
        ]);
    }

    public static function index2(Router $router)
    {
        $empleados = Empleado::find(2); 
        $router->render('empleado/registro', [
            'empleados' => $empleados
        ]);
    }

    public static function index3(Router $router)
    {
        $empleados = Empleado::find(2); 
        $router->render('empleado/lista', [
            'empleados' => $empleados
        ]);
    }

    public static function index4(Router $router)
    {
        $empleados = Empleado::find(2); 
        $router->render('empleado/perfil', [
            'empleados' => $empleados
        ]);
    }

    public static function datatable(Router $router)
    {
        $router->render('empleado/datatable', [ ]);
    }

    public static function guardarAPI()
    {
        $_POST['emp_nombre'] = htmlspecialchars($_POST['emp_nombre']);
        try {
            $empleado = new Empleado($_POST);
            $empleado = $empleado->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Empleado guardado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar empleado',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
    {
        try {
            $empleados = Empleado::obtenerEmpleadosConQuery(); 
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $empleados
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar empleados',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        $_POST['emp_nombre'] = htmlspecialchars($_POST['emp_nombre']);
        $id = filter_var($_POST['emp_id'], FILTER_SANITIZE_NUMBER_INT);
        try {
            $empleado = Empleado::find($id);
            $empleado->sincronizar($_POST);
            $empleado->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Empleado modificado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar empleado',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {
        $id = filter_var($_POST['emp_id'], FILTER_SANITIZE_NUMBER_INT);
        try {
            $empleado = Empleado::find($id);
            $empleado->sincronizar([
                'emp_situacion' => 0 
            ]);

            $empleado->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Empleado eliminado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar empleado',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
