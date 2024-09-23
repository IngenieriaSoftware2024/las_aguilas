<?php

namespace Model;

class Empleado extends ActiveRecord
{
    protected static $tabla = 'empleado'; 
    protected static $idTabla = 'emp_id'; 
    protected static $columnasDB = ['emp_nombre', 'emp_dpi', 'emp_direccion', 'emp_tel', 'emp_situacion']; 

    public $emp_id;
    public $emp_nombre;
    public $emp_dpi; 
    public $emp_direccion;
    public $emp_tel;  
    public $emp_situacion;

    public function __construct($args = [])
    {
        $this->emp_id = $args['emp_id'] ?? null;
        $this->emp_nombre = $args['emp_nombre'] ?? '';
        $this->emp_dpi = $args['emp_dpi'] ?? ''; 
        $this->emp_direccion = $args['emp_direccion'] ?? ''; 
        $this->emp_tel = $args['emp_tel'] ?? ''; 
        $this->emp_situacion = $args['emp_situacion'] ?? 1; 
    }

    public static function obtenerEmpleadosConQuery()
    {
        $sql = "SELECT * FROM " . self::$tabla . " WHERE emp_situacion = 1"; 
        return self::fetchArray($sql);
    }

    public static function buscar()
    {
        $sql = "SELECT * FROM empleado where emp_situacion = 1";
        return self::fetchArray($sql);
    }
}
