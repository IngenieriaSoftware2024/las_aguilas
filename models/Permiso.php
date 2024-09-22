<?php

namespace Model;
class Permiso extends ActiveRecord
{
    protected static $tabla = 'permiso'; 
    protected static $idTabla = 'per_id'; 
    protected static $columnasDB = ['per_usuario', 'per_rol', 'per_situacion']; 

    public $per_id;
    public $per_usuario;
    public $per_rol; 
    public $per_situacion;

    public function __construct($args = [])
    {
        $this->per_id = $args['per_id'] ?? null;
        $this->per_usuario = $args['per_usuario'] ?? '';
        $this->per_rol = $args['per_rol'] ?? ''; 
        $this->per_situacion = $args['per_situacion'] ?? 1; 
    }

    public static function obtenerPermisosConQuery()
    {
        $sql = "SELECT * FROM " . self::$tabla . " WHERE per_situacion = 1"; 
        return self::fetchArray($sql);
    }
}
