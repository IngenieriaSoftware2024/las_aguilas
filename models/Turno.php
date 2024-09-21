<?php

namespace Model;

class Turno extends ActiveRecord
{
    protected static $tabla = 'puestos';
    protected static $idTabla = 'puesto_id';  
    protected static $columnasDB = ['puesto_nombre', 'puesto_descripcion', 'puesto_cliente_id', 'puesto_situacion'];

    public $puesto_id;
    public $puesto_nombre;
    public $puesto_descripcion;
    public $puesto_cliente_id;
    public $puesto_situacion;


    public function __construct($args = [])
    {
        $this->puesto_id = $args['puesto_id'] ?? null;
        $this->puesto_nombre = $args['puesto_nombre'] ?? '';
        $this->puesto_descripcion = $args['puesto_descripcion'] ?? '';
        $this->puesto_cliente_id = $args['puesto_cliente_id'] ?? '';
        $this->puesto_situacion = $args['puesto_situacion'] ?? 1;
    }

    public static function obtenerTurnosconQuery()
    {
        $sql = "SELECT * FROM puestos where situacion = 1";
        return self::fetchArray($sql);
    }

}
