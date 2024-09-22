<?php

namespace Controllers;

use Model\Cliente;
use Model\DetalleFactura;
use MVC\Router;

class FacturaController
{
    public static function index(Router $router)
    {

        $sql = "SELECT cliente_id, cliente_nombre, cliente_nit FROM clientes WHERE cliente_situacion = 1";
        $clientes = Cliente::fetchArray($sql);

        $router->render('factura/factura', [
            'clientes' => $clientes
        ]);
    }


    public static function generarAPI() {

        $_POST['factura_ciente'] = filter_var($_POST['factura_ciente'], FILTER_VALIDATE_INT);
        $_POST['factura_mes'] = filter_var($_POST['factura_mes'], FILTER_VALIDATE_INT);
        $_POST['factura_anio'] = filter_var($_POST['factura_anio'], FILTER_VALIDATE_INT);

        $db = DetalleFactura::getDB();

        $db->beginTransaction();

        
   
    }
}
