<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuario'; 
    protected static $idTabla = 'usu_id'; 
    protected static $columnasDB = ['usu_id', 'usu_nombre', 'usu_catalogo', 'usu_password', 'usu_situacion'];

    public $usu_id;
    public $usu_nombre;
    public $usu_catalogo;
    public $usu_password;
    public $usu_situacion;

    public function __construct($args = [])
    {
        $this->usu_id = $args['usu_id'] ?? null;
        $this->usu_nombre = $args['usu_nombre'] ?? '';
        $this->usu_catalogo = $args['usu_catalogo'] ?? null;
        $this->usu_password = $args['usu_password'] ?? '';
        $this->usu_situacion = $args['usu_situacion'] ?? 1;
    }

    public static function obtenerUsuariosConQuery()
    {
        $sql = "SELECT * FROM " . self::$tabla . " WHERE usu_situacion = 1"; 
        return self::fetchArray($sql);
    }

    public function validarUsuarioExistente() : bool
    {
        $sql = "SELECT * FROM usuario where usu_catalogo = $this->usu_catalogo";
        $resultado = static::fetchArray($sql);
        return $resultado ? true : false;
    }
    public function usuarioExistente(): array
    {
        $sql = "SELECT usu_id,usu_nombre, usu_password, usu_catalogo, rol_nombre from permiso inner join usuario on per_usuario = usu_id inner join rol on rol_id = per_rol inner join aplicacion on rol_app = app_id where per_situacion = 1 AND rol_situacion = 1 AND usu_catalogo = $this->usu_catalogo";
        $resultado = static::fetchFirst($sql);
        return $resultado;
    }

}