<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\EmpleadoController;
use Controllers\PerfilController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/empleado', [EmpleadoController::class, 'index']);
$router->get('/empleado/registro', [EmpleadoController::class, 'index2']);
$router->get('/empleado/lista', [EmpleadoController::class, 'index3']);
$router->get('/perfil', [PerfilController::class, 'index']);


$router->get('/API/empleado/buscar', [EmpleadoController::class, 'buscarAPI']);
$router->post('/API/empleado/guardar', [EmpleadoController::class, 'guardarAPI']);
$router->post('/API/empleado/modificar', [EmpleadoController::class, 'modificarAPI']);
$router->post('/API/empleado/eliminar', [EmpleadoController::class, 'eliminarAPI']);

$router->get('/API/perfil/buscar', [PerfilController::class, 'buscarAPI']);
$router->post('/API/perfil/guardar', [PerfilController::class, 'guardarAPI']);
$router->post('/API/perfil/modificar', [PerfilController::class, 'modificarAPI']);
$router->post('/API/perfil/eliminar', [PerfilController::class, 'eliminarAPI']);

$router->get('/datatable', [EmpleadoController::class, 'datatable']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
