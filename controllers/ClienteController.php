<?php

namespace Controllers;

use Exception;
use Model\Cliente;
use MVC\Router;
use phpseclib3\Net\SFTP;

class ClienteController
{
    public static function index(Router $router)
    {
        $router->render('clientes/cliente', []);
    }

    public static function guardarAPI()
    {
        $mensaje = '';
        $codigo = 0;
        $detalle = '';

        if (isset($_FILES['cliente_contrato'])) {
            if ($_FILES['cliente_contrato']['type'] === 'application/pdf') {
                try {
                    $ftpServer = $_ENV['FILE_SERVER'];
                    $ftpUsername = $_ENV['FILE_USER'];
                    $ftpPassword = $_ENV['FILE_PASSWORD'];
                    $ruta = $_ENV['FILE_DIR'];

                    $contrato = $_FILES['cliente_contrato'];
                    $nombreArchivo = $_POST['cliente_nit'] . '.pdf';

                    $sftp = new SFTP($ftpServer);
                    if (!$sftp->login($ftpUsername, $ftpPassword)) {
                        $mensaje = 'Error al conectarse al servidor SFTP';
                        http_response_code(500);
                        echo json_encode(['codigo' => $codigo, 'mensaje' => $mensaje]);
                        return;
                    }

                    $rutaArchivo = $ruta . '/' . $nombreArchivo;
                    $subido = $sftp->put($rutaArchivo, $contrato['tmp_name'], SFTP::SOURCE_LOCAL_FILE);

                    if ($subido) {
                        $_POST['cliente_contrato'] = $rutaArchivo;

                        $_POST['cliente_nombre'] = htmlspecialchars($_POST['cliente_nombre']);
                        $_POST['cliente_propietario'] = htmlspecialchars($_POST['cliente_propietario']);
                        $_POST['cliente_nit'] = filter_var($_POST['cliente_nit'], FILTER_VALIDATE_INT);
                        $_POST['cliente_telefono'] = filter_var($_POST['cliente_telefono'], FILTER_VALIDATE_INT);
                        $_POST['cliente_email'] = filter_var($_POST['cliente_email'], FILTER_VALIDATE_EMAIL);

                        try {
                            $cliente = new Cliente($_POST);
                            $resultado = $cliente->crear();
                            $codigo = 1;
                            $mensaje = 'Cliente Guardado Correctamente';
                            http_response_code(200);
                        } catch (Exception $error) {
                            $codigo = 0;
                            $mensaje = 'Error al Guardar Registro';
                            $detalle = $error->getMessage();
                            http_response_code(500);
                        }
                    } else {
                        $mensaje = 'Error al subir el archivo al servidor SFTP';
                        http_response_code(500);
                    }
                } catch (Exception $e) {
                    $mensaje = 'Ocurrió un error inesperado';
                    $detalle = $e->getMessage();
                    http_response_code(500);
                }
            } else {
                $mensaje = 'Solo se permiten archivos PDF';
                http_response_code(400);
            }
        }

        echo json_encode([
            'codigo' => $codigo,
            'mensaje' => $mensaje,
            'detalle' => $detalle
        ]);
    }

    public static function buscarAPI()
    {
        try {

            $sql = "SELECT * FROM clientes where cliente_situacion = 1";

            $clientes = Cliente::fetchArray($sql);
            http_response_code(200);
            echo json_encode($clientes);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar clientes',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function MostrarContrato()
    {
        $nit = $_GET['nit'];
        try {
            $ftpServer = $_ENV['FILE_SERVER'];
            $ftpUsername = $_ENV['FILE_USER'];
            $ftpPassword = $_ENV['FILE_PASSWORD'];
            $remoteFilePath = $_ENV['FILE_DIR'];

            $sftp = new SFTP($ftpServer);
            $conectado = $sftp->login($ftpUsername, $ftpPassword);

            if (!$conectado) {
                throw new Exception('No se pudo conectar', 500);
            }

            $ruta = $remoteFilePath . "{$nit}.pdf";
            $fileData = $sftp->get($ruta);


            if ($fileData === false) {
                throw new Exception('No se pudo obtener el archivo.');
            }

            header('Content-Type: application/pdf');
            echo $fileData;
        } catch (Exception $e) {
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error mostrando archivo',
                'detalle' => $e->getMessage(),
            ], 500);
        }
    }
}
