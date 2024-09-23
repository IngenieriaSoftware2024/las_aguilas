<?php

namespace Model;

class Documento extends ActiveRecord
{
    protected static $tabla = 'documento'; 
    protected static $idTabla = 'doc_id'; 
    protected static $columnasDB = ['doc_nombre', 'doc_ruta', 'doc_situacion']; 

    public $doc_id;
    public $doc_nombre;
    public $doc_ruta;  
    public $doc_situacion;

    public function __construct($args = [])
    {
        $this->doc_id = $args['doc_id'] ?? null;
        $this->doc_nombre = $args['doc_nombre'] ?? '';
        $this->doc_ruta = $args['doc_ruta'] ?? ''; 
        $this->doc_situacion = $args['doc_situacion'] ?? 1; 
    }

    public static function obtenerDocumentosActivos()
    {
        $sql = "SELECT * FROM " . self::$tabla . " WHERE doc_situacion = 1"; 
        return self::fetchArray($sql);
    }

    public static function buscar()
    {
        $sql = "SELECT * FROM " . self::$tabla . " WHERE doc_situacion = 1";
        return self::fetchArray($sql);
    }
}
