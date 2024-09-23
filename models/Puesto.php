<?php

namespace Model;

class Puesto extends ActiveRecord
{
    protected static $tabla = 'puestos';
    protected static $idTabla = 'puesto_id';  
    protected static $columnasDB = ['puesto_nombre', 'puesto_descripcion', 'puesto_salario', 'puesto_direccion', 'puesto_cliente', 'puesto_situacion'];

    public $puesto_id;
    public $puesto_nombre;
    public $puesto_descripcion;
    public $puesto_salario;
    public $puesto_direccion;
    public $puesto_cliente;
    public $puesto_situacion;


    public function __construct($args = [])
    {
        $this->puesto_id = $args['puesto_id'] ?? null;
        $this->puesto_nombre = $args['puesto_nombre'] ?? '';
        $this->puesto_descripcion = $args['puesto_descripcion'] ?? '';
        $this->puesto_salario = $args['puesto_salario'] ?? 0;
        $this->puesto_direccion = $args['puesto_direccion'] ?? '';
        $this->puesto_cliente = $args['puesto_cliente'] ?? '';
        $this->puesto_situacion = $args['puesto_situacion'] ?? 1;
    }

    public static function obtenerPuestosconQuery()
    {
        $sql = "SELECT * FROM puestos where puesto_situacion = 1";
        return self::fetchArray($sql);
    }

    public static function buscar()
    {
        $sql = "SELECT * FROM puestos where puesto_situacion = 1";
        return self::fetchArray($sql);
    }

}
