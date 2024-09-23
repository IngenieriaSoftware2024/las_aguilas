<?php

namespace Model;

class Rol extends ActiveRecord
{
    protected static $tabla = 'rol'; 
    protected static $idTabla = 'rol_id'; 
    protected static $columnasDB = ['rol_nombre', 'rol_app', 'rol_situacion'];

    public $rol_id;
    public $rol_nombre;
    public $rol_app;
    public $rol_situacion;

    public function __construct($args = [])
    {
        $this->rol_id = $args['rol_id'] ?? null;
        $this->rol_nombre = $args['rol_nombre'] ?? '';
        $this->rol_app = $args['rol_app'] ?? null;
        $this->rol_situacion = $args['rol_situacion'] ?? 1;
    }

    public static function obtenerRolesActivos()
    {
        $sql = "SELECT * FROM " . self::$tabla . " WHERE rol_situacion = 1"; 
        return self::fetchArray($sql);
    }
}
