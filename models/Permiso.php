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
        $this->per_usuario = $args['usu_id'] ?? ''; 
        $this->per_rol = $args['rol_id'] ?? ''; 
        $this->per_situacion = $args['per_situacion'] ?? 1; 
    }
    
    public static function obtenerPermisosConQuery()
    {
        $sql = "SELECT p.per_id, u.usu_nombre, r.rol_nombre, rol_situacion 
FROM permiso p
JOIN usuario u ON p.per_usuario = u.usu_id
JOIN rol r ON p.per_rol = r.rol_id;"; 
        return self::fetchArray($sql);
    }
}
