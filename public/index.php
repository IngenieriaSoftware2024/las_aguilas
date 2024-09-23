<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;

use Controllers\ClienteController;
use Controllers\FtpController;

use Controllers\EmpleadoController;
use Controllers\FacturaController;
use Controllers\PerfilController;

use Controllers\PuestoController;
use Controllers\TurnoController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/API/empleado/buscar', [EmpleadoController::class, 'buscarAPI']);
$router->post('/API/empleado/guardar', [EmpleadoController::class, 'guardarAPI']);
$router->post('/API/empleado/modificar', [EmpleadoController::class, 'modificarAPI']);
$router->post('/API/empleado/eliminar', [EmpleadoController::class, 'eliminarAPI']);

$router->get('/', [AppController::class,'index']);
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

  
  //puestos
$router->get('/puestos', [PuestoController::class, 'index']);
$router->get('/API/puesto/buscar', [PuestoController::class, 'buscarAPI']);
$router->post('/API/puesto/guardar', [PuestoController::class, 'guardarAPI']);
$router->post('/API/puesto/modificar', [PuestoController::class, 'modificarAPI']);
$router->post('/API/puesto/eliminar', [PuestoController::class, 'eliminarAPI']);

//turnos
$router->get('/turnos', [TurnoController::class, 'index']);
$router->get('/API/turno/buscar', [TurnoController::class, 'buscarAPI']);
$router->post('/API/turno/guardar', [TurnoController::class, 'guardarAPI']);
$router->post('/API/turno/modificar', [TurnoController::class, 'modificarAPI']);
$router->post('/API/turno/eliminar', [TurnoController::class, 'eliminarAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();