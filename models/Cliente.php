<?php

namespace Model;

class Cliente extends ActiveRecord
{
    protected static $tabla = 'clientes';
    protected static $idTabla = 'cliente_id';

    protected static $columnasDB = ['cliente_nombre', 'cliente_nit','cliente_propietario', 'cliente_telefono', 'cliente_email', 'cliente_ubicacion', 'cliente_contrato', 'cliente_situacion'];

    public $cliente_id;
    public $cliente_nombre;
    public $cliente_nit;
    public $cliente_propietario;
    public $cliente_telefono;
    public $cliente_email;
    public $cliente_ubicacion;
    public $cliente_contrato;
    public $cliente_situacion;

    public function __construct($args = [])
    {
        $this->cliente_id = $args['cliente_id'] ?? '';
        $this->cliente_nombre = $args['cliente_nombre'] ?? '';
        $this->cliente_nit = $args['cliente_nit'] ?? 0;
        $this->cliente_propietario = $args['cliente_propietario'] ?? '';
        $this->cliente_telefono = $args['cliente_telefono'] ?? 0;
        $this->cliente_email = $args['cliente_email'] ?? '';
        $this->cliente_ubicacion = $args['cliente_ubicacion'] ?? '';
        $this->cliente_contrato = $args['cliente_contrato'] ?? '';
        $this->cliente_situacion = $args['cliente_situacion'] ?? 1;
    }
}
