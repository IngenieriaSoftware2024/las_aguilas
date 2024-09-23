<?php

namespace Controllers;

use Exception;
use Model\Cliente;
use Model\DetalleFactura;
use Model\EncabezadoFactura;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
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


    // public static function generarAPI()
    // {

    //     $_POST['factura_correlativo'] = uniqid();

    //     $factura_correlativo = $_POST['factura_correlativo'];
    //     $factura_cliente = $_POST['factura_cliente'];
    //     $factura_nit = $_POST['factura_nit'];
    //     $factura_mes = $_POST['factura_mes'];
    //     $factura_anio = $_POST['factura_anio'];

    //     $detalle_cantidad_empleados = $_POST['detalle_cantidad_empleados'];
    //     $detalle_empleados = $_POST['detalle_empleados'];
    //     $detalle_total = $_POST['detalle_total'];


    //     $db = DetalleFactura::getDB();

    //     try {

    //         $db->beginTransaction();


    //         $sql_encabezado = "INSERT INTO encabezado_factura (factura_correlativo, factura_cliente, factura_NIT, factura_mes, factura_anio) VALUES ('$factura_correlativo', '$factura_cliente', '$factura_nit', '$factura_mes', '$factura_anio')";

    //         $ejecutar = EncabezadoFactura::EjectuarQuery($sql_encabezado);

    //         $factura_id = $db->lastInsertId();


    //         $sql_detalle = "INSERT INTO detalle_factura (detalle_encabezado, detalle_cantidad_empleados, detalle_empleados, detalle_total) VALUES ('$factura_id', '$detalle_cantidad_empleados', '$detalle_empleados', '$detalle_total')";
    //         $execute = DetalleFactura::EjectuarQuery($sql_detalle);

    //         $db->commit();

    //         echo json_encode([
    //             'codigo' => 1,
    //             'mensaje' => 'Factura Generada exitosamente',
    //         ]);
    //     } catch (Exception $e) {
    //         $db->rollBack();
    //         echo json_encode([
    //             'codigo' => 0,
    //             'mensaje' => 'Error al generar la factura',
    //             'detalle' => $e->getMessage()
    //         ]);
    //     }
    //     exit;
    // }

    public static function generarAPI()
    {
        $_POST['factura_correlativo'] = uniqid();

        $factura_correlativo = $_POST['factura_correlativo'];
        $factura_cliente = $_POST['factura_cliente'];
        $factura_nit = $_POST['factura_nit'];
        $factura_mes = $_POST['factura_mes'];
        $factura_anio = $_POST['factura_anio'];

        $detalle_cantidad_empleados = $_POST['detalle_cantidad_empleados'];
        $detalle_empleados = $_POST['detalle_empleados'];
        $detalle_total = $_POST['detalle_total'];

        $db = DetalleFactura::getDB();

        try {

            $sql_encabezado = "INSERT INTO encabezado_factura (factura_correlativo, factura_cliente, factura_NIT, factura_mes, factura_anio) 
                               VALUES ('$factura_correlativo', '$factura_cliente', '$factura_nit', '$factura_mes', '$factura_anio')";
            $ejecutar = EncabezadoFactura::EjectuarQuery($sql_encabezado);
            $factura_id = $db->lastInsertId();


            $sql_detalle = "INSERT INTO detalle_factura (detalle_encabezado, detalle_cantidad_empleados, detalle_empleados, detalle_total) 
                            VALUES ('$factura_id', '$detalle_cantidad_empleados', '$detalle_empleados', '$detalle_total')";
            $execute = DetalleFactura::EjectuarQuery($sql_detalle);

            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Factura Generada exitosamente',
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al generar la factura',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    public static function buscarAPI()
    {
        try {

            $sql = "SELECT detalle_id, factura_id, cliente_id, cliente_nombre, factura_correlativo, factura_mes, factura_anio 
                FROM encabezado_factura 
                INNER JOIN clientes ON factura_cliente = cliente_id
                INNER JOIN detalle_factura ON detalle_encabezado = factura_id WHERE detalle_situacion = 1 AND factura_situacion = 1 AND cliente_situacion = 1;";

            $datos = EncabezadoFactura::fetchArray($sql);
            http_response_code(200);
            echo json_encode($datos);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar facturas',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function getEmpleados()
    {
        $id = $_GET['id'];
        $query =  "SELECT COUNT(emp_nombre) AS cantidad, puesto_nombre AS puesto, puesto_salario AS salario FROM turnos
                    INNER JOIN empleado ON emp_id = turno_empleado
                    INNER JOIN puestos ON turno_puesto = puesto_id
                    INNER JOIN clientes ON puesto_cliente = cliente_id
                    WHERE cliente_id = $id
                    GROUP BY puesto_nombre, puesto_salario;";

        $datos = Cliente::fetchFirst($query);

        echo json_encode($datos);
    }

    public static function buscarFacturas()
{
    $mes = $_GET['mes'] ?? null;
    $anio = $_GET['anio'] ?? null;
    $id = $_GET['cliente'] ?? null;

    try {
        $query = "SELECT detalle_id, factura_id, cliente_id, cliente_nombre, factura_correlativo, factura_mes, factura_anio FROM encabezado_factura INNER JOIN clientes ON factura_cliente = cliente_id INNER JOIN detalle_factura ON detalle_encabezado = factura_id WHERE detalle_situacion = 1 AND factura_situacion = 1 AND cliente_situacion = 1";

        if ($id) {
            $query .= " AND factura_cliente = " . intval($id);
        }
        if ($mes) {
            $query .= " AND factura_mes = " . intval($mes);
        }
        if ($anio) {
            $query .= " AND factura_anio = " . intval($anio);
        }

        $datos = EncabezadoFactura::fetchArray($query);

        echo json_encode([
            'codigo' => 1,
            'mensaje' => 'Datos encontrados exitosamente',
            'detalle' => $datos,
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'Error al buscar los datos',
            'detalle' => $e->getMessage(),
        ]);
    }
}



    public static function generarPdf(Router $router)
    {
        $cliente_id = $_POST['cliente_id'];
        $detalle_id = $_POST['detalle_id'];
        $factura_id = $_POST['factura_id'];

        // Consulta SQL para obtener los datos de la factura
        $sql = "SELECT cliente_nombre, cliente_nit, factura_correlativo, detalle_cantidad_empleados, detalle_empleados, detalle_total 
            FROM encabezado_factura
            INNER JOIN clientes ON factura_cliente = cliente_id
            INNER JOIN detalle_factura ON detalle_encabezado = factura_id 
            WHERE cliente_situacion = 1
            AND detalle_situacion = 1
            AND factura_situacion = 1
            AND cliente_id = $cliente_id
            AND detalle_id = $detalle_id
            AND factura_id = $factura_id";

        // Obtener los datos
        $data = EncabezadoFactura::fetchFirst($sql);

        if (!$data) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Datos de la factura no encontrados.'
            ]);
            return;
        }


        $mpdf = new Mpdf([
            "default_font_size" => "12",
            "default_font" => "arial",
            "orientation" => "P",
            "margin_top" => "30",
            "format" => "Letter"
        ]);


        $html = $router->load('PdfFactura/factura', [
            'data' => $data
        ]);


        $css = $router->load('PdfFactura/style');


        $mpdf->WriteHTML($css, HTMLParserMode::HEADER_CSS);

        $mpdf->WriteHTML($html, HTMLParserMode::HTML_BODY);

        $mpdf->Output("Factura_" . $data['factura_correlativo'] . ".pdf", "I");
    }
}
