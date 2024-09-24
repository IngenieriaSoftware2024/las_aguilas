<?php

namespace Controllers;

use Exception;
use Model\Turno;
use MVC\Router;

class TurnoController
{
    public static function index(Router $router)
    {
        isAuth();
        hasPermission(['ADMINISTRA']);

        $turnos = Turno::find(2);
        $router->render('turnos/index', [
            'turnos' => $turnos
        ],  'layouts/menu');
    }

    public static function index2(Router $router)
    {
        isAuth();
        hasPermission(['ADMINISTRA', 'SUPERVISOR', 'AGENTE']);

        $turnos = Turno::find(2);
        $router->render('turnos/lista', [
            'turnos' => $turnos
        ],  'layouts/menu');
    }
    
    public static function guardarAPI()
    {
        $_POST['turno_empleado'] = filter_var($_POST['turno_empleado'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['turno_puesto'] = filter_var($_POST['turno_puesto'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['turno_fecha_inicio'] = date('Y-m-d H:i', strtotime($_POST['turno_fecha_inicio']));
        $_POST['turno_fecha_fin'] = date('Y-m-d H:i', strtotime($_POST['turno_fecha_fin']));

        //$fecha_entrada = date('Y-m-d H:i', strtotime($_POST['reser_fecha_entrada']));
        //$_POST['reser_fecha_entrada'] = date('Y-m-d H:i', strtotime($_POST['reser_fecha_entrada']));
        //$_POST['reser_fecha_salida'] = date('Y-m-d H:i', strtotime($_POST['reser_fecha_salida'])); // Cambiado a guion bajo


        try {
            $turno = new Turno($_POST);
            $resultado = $turno->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Turno guardado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar turno',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
    {
        try {
            // ORM - ELOQUENT
            // $turnos = Turno::all();
            $turnos = Turno::obtenerTurnosconQuery();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $turnos
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar turnos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
   
    public static function modificarAPI()
    {
        $_POST['turno_empleado'] = filter_var($_POST['turno_empleado'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['turno_puesto'] = filter_var($_POST['turno_puesto'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['turno_fecha_inicio'] = date('Y-m-d H:i', strtotime($_POST['turno_fecha_inicio']));
        $_POST['turno_fecha_fin'] = date('Y-m-d H:i', strtotime($_POST['turno_fecha_fin']));
        $id = filter_var($_POST['turno_id'], FILTER_SANITIZE_NUMBER_INT);
        try {

            $turno = Turno::find($id);
            $turno->sincronizar($_POST);
            $turno->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Turno modificado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar turno',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {

        $id = filter_var($_POST['turno_id'], FILTER_SANITIZE_NUMBER_INT);
        try {

            $turno = Turno::find($id);
            // $turno->sincronizar([
            //     'situacion' => 0
            // ]);
            // $turno->actualizar();
            $turno->eliminar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Turno eliminado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminado turno',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
