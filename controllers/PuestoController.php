<?php

namespace Controllers;

use Exception;
use Model\Puesto;
use MVC\Router;

class PuestoController
{
    public static function index(Router $router)
    {
        $puestos = Puesto::find(2);
        $router->render('puestos/index', [
            'puestos' => $puestos
        ]);
    }
    

    public static function guardarAPI()
    {
        $_POST['puesto_nombre'] = htmlspecialchars($_POST['puesto_nombre']);
        $_POST['puesto_descripcion'] = htmlspecialchars($_POST['puesto_descripcion']);
        $_POST['puesto_salario'] = filter_var($_POST['puesto_salario'], FILTER_SANITIZE_NUMBER_FLOAT);
        $_POST['puesto_direccion'] = htmlspecialchars($_POST['puesto_direccion']);
        $_POST['puesto_cliente'] = filter_var($_POST['puesto_cliente'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $puesto = new Puesto($_POST);
            $resultado = $puesto->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Puesto guardado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar puesto',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
    {
        try {
            // ORM - ELOQUENT
            // $puestos = Puesto::all();
            $puestos = Puesto::obtenerPuestosconQuery();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $puestos
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar puestos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
   
    public static function modificarAPI()
    {
        $_POST['puesto_nombre'] = htmlspecialchars($_POST['puesto_nombre']);
        $_POST['puesto_descripcion'] = htmlspecialchars($_POST['puesto_descripcion']);
        $_POST['puesto_salario'] = filter_var($_POST['puesto_salario'], FILTER_SANITIZE_NUMBER_FLOAT);
        $_POST['puesto_direccion'] = htmlspecialchars($_POST['puesto_direccion']);
        $_POST['puesto_cliente'] = filter_var($_POST['puesto_cliente'], FILTER_SANITIZE_NUMBER_INT);
        $id = filter_var($_POST['puesto_id'], FILTER_SANITIZE_NUMBER_INT);
        try {

            $puesto = Puesto::find($id);
            $puesto->sincronizar($_POST);
            $puesto->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Puesto modificado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar puesto',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {

        $id = filter_var($_POST['puesto_id'], FILTER_SANITIZE_NUMBER_INT);
        try {

            $puesto = Puesto::find($id);
            // $puesto->sincronizar([
            //     'situacion' => 0
            // ]);
            // $puesto->actualizar();
            $puesto->eliminar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Puesto eliminado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminado puesto',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
