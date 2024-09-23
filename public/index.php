<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;

use Controllers\ClienteController;
use Controllers\FtpController;
use Controllers\UsuarioController;
use Controllers\PermisoController;
use Controllers\EmpleadoController;
use Controllers\RolController;
use Model\Usuario;

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

$router->get('/empleado', [EmpleadoController::class, 'index']);
$router->get('/empleado/registro', [EmpleadoController::class, 'index2']);
$router->get('/empleado/lista', [EmpleadoController::class, 'index3']);

$router->get('/usuario', [UsuarioController::class, 'index']);
$router->get('/API/usuario/buscar', [UsuarioController::class, 'buscarAPI']);
$router->post('/API/usuario/guardar', [UsuarioController::class, 'guardarAPI']);
$router->post('/API/usuario/modificar', [UsuarioController::class, 'modificarAPI']);
$router->post('/API/usuario/eliminar', [UsuarioController::class, 'eliminarAPI']);
$router->get('/datatable', [UsuarioController::class, 'datatable']);

$router->get('/permiso', [PermisoController::class, 'index']);
$router->get('/API/permiso/buscar', [PermisoController::class, 'buscarAPI']);
$router->post('/API/permiso/guardar', [PermisoController::class, 'guardarAPI']);
$router->post('/API/permiso/modificar', [PermisoController::class, 'modificarAPI']);
$router->post('/API/permiso/eliminar', [PermisoController::class, 'eliminarAPI']);
$router->get('/datatable', [PermisoController::class, 'datatable']);

$router->get('/datatable', [EmpleadoController::class, 'datatable']);

$router->get('/rol', [RolController::class, 'index']);
$router->get('/API/rol/buscar', [RolController::class, 'buscarAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
