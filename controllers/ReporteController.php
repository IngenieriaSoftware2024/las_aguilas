<?php

namespace Controllers;

use Mpdf\Mpdf;
use Model\ActiveRecord;
use MVC\Router;

class ReporteController {
    public static function pdf(Router $router)
    {
        
        $mpdf = new Mpdf(
            [
                'default_font_size' => '12',
                'default_font' => 'arial',
                'orientation' => 'p',
                'margin_top' => '30',
                'format' => 'Letter',
                //'format' => [35,45],
            ]
        );

        $sql = ActiveRecord::fetchArray("SELECT turno_id, emp_nombre, puesto_nombre, turno_fecha_inicio, turno_fecha_fin FROM turnos JOIN empleado ON turno_empleado = emp_id JOIN puestos ON turno_puesto = puesto_id WHERE turno_situacion = 1;");
        $resultado = $sql;

        $html = $router->load('pdf/reporte',[
            'resultado' => $resultado
        ]);

        $header = $router->load('pdf/header', []);
        $footer = $router->load('pdf/footer', []);
        $css = $router->load('pdf/style', []);

        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);

        $mpdf->WriteHTML($css);
        $mpdf->WriteHTML($html);
        $mpdf->Output();


        
        // Define la ruta de la carpeta 'temp' en el directorio 'public'
        $publicDir = __DIR__ . '../../public/temp'; // Ajusta según la estructura de tu proyecto
        $tempDir = $publicDir . '/temp/';
        $fileName = 'reporte.pdf';
        $filePath = $tempDir . $fileName;

        // Asegúrate de que la carpeta 'temp' exista
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Guarda el PDF en el archivo especificado
        $mpdf->Output($filePath, 'F');

    }

}

