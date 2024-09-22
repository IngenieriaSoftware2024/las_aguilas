<?php

namespace Model;

class DetalleFactura extends ActiveRecord
{
    protected static $tabla = 'detalle_factura';
    protected static $idTabla = 'detalle_id';

    protected static $columnasDB = ['detalle_encabezado', 'detalle_cantidad_empleados','detalle_empleados', 'detalle_total', 'detalle_situacion'];

    public $detalle_id;
    public $detalle_encabezado;
    public $detalle_cantidad_empleados;
    public $detalle_empleados;
    public $detalle_total;
    public $detalle_situacion;


    public function __construct($args = [])
    {
        $this->detalle_id = $args['detalle_id'] ?? '';
        $this->detalle_encabezado = $args['detalle_encabezado'] ?? '';
        $this->detalle_cantidad_empleados = $args['detalle_cantidad_empleados'] ?? '';
        $this->detalle_empleados = $args['detalle_empleados'] ?? '';
        $this->detalle_total = $args['detalle_total'] ?? '';
        $this->detalle_situacion = $args['detalle_situacion'] ?? '';


    }
}
