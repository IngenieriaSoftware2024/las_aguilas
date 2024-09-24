<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ClienteController;
use Controllers\DocumentoController;
use Controllers\EmpleadoController;
use Controllers\FacturaController;
use Controllers\GraficaController;
use Controllers\FtpController;
use Controllers\InicioController;
use Controllers\PermisoController;

use Controllers\LoginController;
use Controllers\PerfilController;

use Controllers\PuestoController;
use Controllers\ReporteController;
use Controllers\RolController;
use Controllers\TurnoController;
use Controllers\UsuarioController;


$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);


$router->get('/', [LoginController::class, 'login']);
$router->post('/API/login', [LoginController::class, 'loginAPI']);
$router->get('/menu', [LoginController::class, 'menu']);
$router->get('/logout', [LoginController::class, 'logout']);


$router->get('/', [LoginController::class, 'login']);
$router->post('/API/login', [LoginController::class, 'loginAPI']);
$router->get('/menu', [LoginController::class, 'menu']);
$router->get('/logout', [LoginController::class, 'logout']);



// Rutas de Empleados
$router->get('/API/empleado/buscar', [EmpleadoController::class, 'buscarAPI']);
$router->post('/API/empleado/guardar', [EmpleadoController::class, 'guardarAPI']);
$router->post('/API/empleado/modificar', [EmpleadoController::class, 'modificarAPI']);
$router->post('/API/empleado/eliminar', [EmpleadoController::class, 'eliminarAPI']);

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
$router->get('/empleado/perfil', [EmpleadoController::class, 'index4']);
$router->get('/datatable', [EmpleadoController::class, 'datatable']);

// Rutas de Clientes
$router->get('/clientes', [ClienteController::class, 'index']);
$router->post('/API/cliente/guardar', [ClienteController::class, 'guardarAPI']);
$router->get('/API/clientes/buscar', [ClienteController::class, 'buscarAPI']);
$router->get('/API/cliente/MostrarContrato', [ClienteController::class, 'MostrarContrato']);
$router->post('/API/cliente/modificar', [ClienteController::class, 'modificarAPI']);
$router->post('/API/cliente/eliminar', [ClienteController::class, 'eliminarAPI']);

// Rutas de Usuarios
$router->get('/usuario', [UsuarioController::class, 'index']);
$router->get('/API/usuario/buscar', [UsuarioController::class, 'buscarAPI']);
$router->post('/API/usuario/guardar', [UsuarioController::class, 'guardarAPI']);
$router->post('/API/usuario/modificar', [UsuarioController::class, 'modificarAPI']);
$router->post('/API/usuario/eliminar', [UsuarioController::class, 'eliminarAPI']);
$router->get('/datatable', [UsuarioController::class, 'datatable']);

// Rutas de Permisos
$router->get('/permiso', [PermisoController::class, 'index']);
$router->get('/API/permiso/buscar', [PermisoController::class, 'buscarAPI']);
$router->post('/API/permiso/guardar', [PermisoController::class, 'guardarAPI']);
$router->post('/API/permiso/modificar', [PermisoController::class, 'modificarAPI']);
$router->post('/API/permiso/eliminar', [PermisoController::class, 'eliminarAPI']);
$router->get('/datatable', [PermisoController::class, 'datatable']);

// Rutas de Facturas
$router->get('/factura', [FacturaController::class, 'index']);
$router->get('/API/totalempleados/buscar', [FacturaController::class, 'getEmpleados']);
$router->post('/API/factura/generar', [FacturaController::class, 'generarAPI']);
$router->get('/API/facturas/buscar', [FacturaController::class, 'buscarAPI']);
$router->post('/API/factura/generarPdf', [FacturaController::class, 'generarPdf']);
$router->get('/API/facturas/busqueda', [FacturaController::class, 'buscarFacturas']);

// Rutas de Roles
$router->get('/rol', [RolController::class, 'index']);
$router->get('/API/rol/buscar', [RolController::class, 'buscarAPI']);

// Rutas de Puestos
$router->get('/puestos', [PuestoController::class, 'index']);
$router->get('/API/puesto/buscar', [PuestoController::class, 'buscarAPI']);
$router->post('/API/puesto/guardar', [PuestoController::class, 'guardarAPI']);
$router->post('/API/puesto/modificar', [PuestoController::class, 'modificarAPI']);
$router->post('/API/puesto/eliminar', [PuestoController::class, 'eliminarAPI']);

// Rutas de Turnos
$router->get('/turnos', [TurnoController::class, 'index']);
$router->get('/turnos/lista', [TurnoController::class, 'index2']);
$router->get('/API/turno/buscar', [TurnoController::class, 'buscarAPI']);
$router->post('/API/turno/guardar', [TurnoController::class, 'guardarAPI']);
$router->post('/API/turno/modificar', [TurnoController::class, 'modificarAPI']);
$router->post('/API/turno/eliminar', [TurnoController::class, 'eliminarAPI']);

// Rutas de Documentos
$router->get('/documento', [DocumentoController::class, 'index']);
$router->get('/API/documento/buscar', [DocumentoController::class, 'buscarAPI']);

// Rutas de Reportes
$router->get('/pdf', [ReporteController::class, 'pdf']);

//grafia Turnos
$router->get('/turnos/estadisticas', [GraficaController::class, 'estadisticas']);
$router->get('/API/turnos/estadisticas', [GraficaController::class, 'turnosPorPuestoAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();