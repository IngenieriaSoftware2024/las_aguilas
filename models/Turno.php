<?php

namespace Model;

class Turno extends ActiveRecord
{

    protected static $tabla = 'turnos';
    protected static $idTabla = 'turno_id';  
    protected static $columnasDB = ['turno_empleado', 'turno_puesto', 'turno_fecha_inicio', 'turno_fecha_fin', 'turno_situacion'];

    public $turno_id;
    public $turno_empleado;
    public $turno_puesto;
    public $turno_fecha_inicio;
    public $turno_fecha_fin;
    public $turno_situacion;




    public function __construct($args = [])
    {

        $this->turno_id = $args['turno_id'] ?? null;
        $this->turno_empleado = $args['turno_empleado'] ?? 0;
        $this->turno_puesto = $args['turno_puesto'] ?? 0;
        $this->turno_fecha_inicio = $args['turno_fecha_inicio'] ?? '';
        $this->turno_fecha_fin = $args['turno_fecha_fin'] ?? '';
        $this->turno_situacion = $args['turno_situacion'] ?? 1;
    }

 

    public static function obtenerTurnosconQuery()
    {
        $sql = "SELECT 
            turno_id,
            emp_nombre,
            puesto_nombre,
            turno_fecha_inicio,
            turno_fecha_fin,
            turno_situacion
        FROM 
            turnos 
        JOIN 
            empleado ON turno_empleado = emp_id
        JOIN 
            puestos ON turno_puesto = puesto_id
        WHERE 
            turno_situacion = 1";

    }

}
