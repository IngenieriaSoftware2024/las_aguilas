<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;

use Controllers\ClienteController;
use Controllers\FacturaController;
use Controllers\FtpController;

use Controllers\EmpleadoController;
use Controllers\PerfilController;


  
$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/API/empleado/buscar', [EmpleadoController::class, 'buscarAPI']);
$router->post('/API/empleado/guardar', [EmpleadoController::class, 'guardarAPI']);
$router->post('/API/empleado/modificar', [EmpleadoController::class, 'modificarAPI']);
$router->post('/API/empleado/eliminar', [EmpleadoController::class, 'eliminarAPI']);

$router->get('/', [AppController::class,'index']);
$router->get('/clientes', [ClienteController::class,'index']);
$router->post('/API/cliente/guardar', [ClienteController::class,'guardarAPI']);
$router->get('/ftp', [FtpController::class,'conexion']);
$router->get('/API/clientes/buscar', [ClienteController::class,'buscarAPI']);
$router->get('/API/cliente/MostrarContrato', [ClienteController::class,'MostrarContrato']);
$router->post('/API/cliente/modificar', [ClienteController::class,'modificarAPI']);
$router->post('/API/cliente/eliminar', [ClienteController::class,'eliminarAPI']);




$router->get('/datatable', [EmpleadoController::class, 'datatable']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
