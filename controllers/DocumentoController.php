<?php

namespace Controllers;

use Exception;
use Model\Documento; 
use MVC\Router;

class DocumentoController 
{
    public static function index(Router $router)
    {
        $documentos = Documento::obtenerDocumentosActivos(); 
        $router->render('documento/index', [
            'documentos' => $documentos
        ]);
    }

    public static function crear(Router $router)
    {
        $documento = new Documento();
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $documento->doc_nombre = $_POST['doc_nombre'] ?? '';
            $documento->doc_ruta = $_POST['doc_ruta'] ?? '';
            $documento->doc_situacion = $_POST['doc_situacion'] ?? 1;

            // Validar campos
            if (empty($documento->doc_nombre)) {
                $errores[] = "El nombre del documento es obligatorio.";
            }
            if (empty($documento->doc_ruta)) {
                $errores[] = "La ruta del documento es obligatoria.";
            }

            // Guardar el documento si no hay errores
            if (empty($errores)) {
                try {
                    if ($documento->guardar()) {
                        header('Location: /documentos');
                        exit; // Asegurarse de detener la ejecución después del redireccionamiento
                    } else {
                        $errores[] = "Error al guardar el documento. Intente nuevamente.";
                    }
                } catch (Exception $e) {
                    $errores[] = "Error al guardar el documento: " . $e->getMessage();
                }
            }
        }

        $router->render('documento/crear', [
            'documento' => $documento,
            'errores' => $errores
        ]);
    }

    public static function editar(Router $router)
    {
        $id = $_GET['id'];
        $documento = Documento::find($id); 
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $documento->doc_nombre = $_POST['doc_nombre'] ?? '';
            $documento->doc_ruta = $_POST['doc_ruta'] ?? '';
            $documento->doc_situacion = $_POST['doc_situacion'] ?? 1;

            // Validar campos
            if (empty($documento->doc_nombre)) {
                $errores[] = "El nombre del documento es obligatorio.";
            }
            if (empty($documento->doc_ruta)) {
                $errores[] = "La ruta del documento es obligatoria.";
            }

            // Actualizar el documento si no hay errores
            if (empty($errores)) {
                try {
                    if ($documento->guardar()) {
                        header('Location: /documentos');
                        exit; // Asegurarse de detener la ejecución después del redireccionamiento
                    } else {
                        $errores[] = "Error al actualizar el documento. Intente nuevamente.";
                    }
                } catch (Exception $e) {
                    $errores[] = "Error al actualizar el documento: " . $e->getMessage();
                }
            }
        }

        $router->render('documento/editar', [
            'documento' => $documento,
            'errores' => $errores
        ]);
    }

    public static function eliminar()
    {
        $id = $_GET['id'];
        $documento = Documento::find($id); 

        if ($documento) {
            try {
                $documento->doc_situacion = 0; 
                $documento->guardar();
            } catch (Exception $e) {
                // Manejar el error al intentar eliminar
                echo "Error al eliminar el documento: " . $e->getMessage();
            }
        }

        header('Location: /documentos');
        exit; // Asegurarse de detener la ejecución después del redireccionamiento
    }

    public static function buscarAPI()
    {
        try {
            $documentos = Documento::obtenerDocumentosActivos(); 
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $documentos
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar documentos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
