<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;

use Controllers\ClienteController;
use Controllers\FtpController;

use Controllers\EmpleadoController;
use Controllers\FacturaController;
use Controllers\InicioController;
use Controllers\PerfilController;


  
$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/API/empleado/buscar', [EmpleadoController::class, 'buscarAPI']);
$router->post('/API/empleado/guardar', [EmpleadoController::class, 'guardarAPI']);
$router->post('/API/empleado/modificar', [EmpleadoController::class, 'modificarAPI']);
$router->post('/API/empleado/eliminar', [EmpleadoController::class, 'eliminarAPI']);

$router->get('/', [InicioController::class,'index']);
$router->get('/API/perfil/buscar', [PerfilController::class, 'buscarAPI']);
$router->post('/API/perfil/guardar', [PerfilController::class, 'guardarAPI']);
$router->post('/API/perfil/modificar', [PerfilController::class, 'modificarAPI']);
$router->post('/API/perfil/eliminar', [PerfilController::class, 'eliminarAPI']);

$router->get('/clientes', [ClienteController::class,'index']);
$router->post('/API/cliente/guardar', [ClienteController::class,'guardarAPI']);
$router->get('/ftp', [FtpController::class,'conexion']);
$router->get('/API/clientes/buscar', [ClienteController::class,'buscarAPI']);
$router->get('/API/cliente/MostrarContrato', [ClienteController::class,'MostrarContrato']);
$router->post('/API/cliente/modificar', [ClienteController::class,'modificarAPI']);
$router->post('/API/cliente/eliminar', [ClienteController::class,'eliminarAPI']);

$router->get('/empleado', [EmpleadoController::class, 'index']);
$router->get('/empleado/registro', [EmpleadoController::class, 'index2']);
$router->get('/empleado/lista', [EmpleadoController::class, 'index3']);
$router->get('/perfil', [PerfilController::class, 'index']);



$router->get('/datatable', [EmpleadoController::class, 'datatable']);




$router->get('/factura', [FacturaController::class, 'index']);
$router->get('/API/totalempleados/buscar', [FacturaController::class, 'getEmpleados']);
$router->post('/API/factura/generar', [FacturaController::class, 'generarAPI']);
$router->get('/API/facturas/buscar', [FacturaController::class, 'buscarAPI']);
$router->post('/API/factura/generarPdf', [FacturaController::class, 'generarPdf']);
$router->get('/API/facturas/busqueda', [FacturaController::class, 'buscarFacturas']);




// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();