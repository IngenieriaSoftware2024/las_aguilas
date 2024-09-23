<?php

namespace Model;

class EncabezadoFactura extends ActiveRecord
{
    protected static $tabla = 'encabezado_factura';
    protected static $idTabla = 'factura_id';

    protected static $columnasDB = ['factura_correlativo', 'factura_cliente','factura_nit', 'factura_mes', 'factura_anio', 'factura_situacion'];

    public $factura_id;
    public $factura_correlativo;
    public $factura_cliente;
    public $factura_nit;
    public $factura_mes;
    public $factura_anio;
    public $factura_situacion;

    public function __construct($args = [])
    {
        $this->factura_id = $args['factura_id'] ?? '';
        $this->factura_correlativo = $args['factura_correlativo'] ?? '';
        $this->factura_cliente = $args['factura_cliente'] ?? '';
        $this->factura_nit = $args['factura_nit'] ?? '';
        $this->factura_mes = $args['factura_mes'] ?? '';
        $this->factura_anio = $args['factura_anio'] ?? '';
        $this->factura_situacion = $args['factura_situacion'] ?? '';

    }
}
