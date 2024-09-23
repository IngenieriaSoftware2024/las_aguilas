<?php

namespace Controllers;

use Exception;
use Model\Turno;
use MVC\Router;

class GraficaController {

    public static function estadisticas(Router $router){
        isAuth();
        hasPermission(['ADMINISTRA', 'SUPERVISOR']);
        $router->render('turnos/estadisticas', 'layouts/menu');
    }
   
    public static function turnosPorPuestoAPI(){
        try{
            $sql = 'SELECT puesto_nombre AS puesto, 
            COUNT(turno_id) AS cantidad_turnos
            FROM turnos
            JOIN puestos ON turno_puesto = puesto_id
            WHERE turno_situacion = 1
            GROUP BY puesto_nombre
            ORDER BY cantidad_turnos DESC';
;
            
            $datos = Turno::fetchArray($sql);
            
            echo json_encode($datos);
        } catch (Exception $e){
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    

}


