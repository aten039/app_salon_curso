<?php 

require_once __DIR__ . "/../includes/app.php";

use Controllers\AdminControllers;
use Controllers\ApiControllers;
use Controllers\CitaControllers;
use Controllers\LoginControllers;
use Controllers\ServicioControllers;
use Models\Servicio;
use MVC\Router;

$router = new Router();
//crear cuentas

$router->get('/crear_cuenta', [LoginControllers::class, 'crear_cuenta']);
$router->post('/crear_cuenta', [LoginControllers::class, 'crear_cuenta']);

//confirmar

$router->get('/confirmar-cuenta', [LoginControllers::class, 'confirmar']);
$router->get('/mensaje', [LoginControllers::class, 'mensaje']);

//iniciar sesion

$router->get('/', [LoginControllers::class, 'login']);
$router->post('/', [LoginControllers::class, 'login']);
$router->get('/logout', [LoginControllers::class, 'logout']);

//recuperar password

$router->get('/recover_pass', [LoginControllers::class, 'recuperarPass']);
$router->post('/recover_pass', [LoginControllers::class, 'recuperarPass']);

$router->get('/recover', [LoginControllers::class, 'recuperar']);
$router->post('/recover', [LoginControllers::class, 'recuperar']);


//area privada

//citas
$router->get('/citas', [CitaControllers::class, 'index']);

//admin
$router->get('/admin', [AdminControllers::class, 'admin']);


//api de citas
$router->get('/api/servicios', [ApiControllers::class, 'index']);
$router->post('/api/citas', [ApiControllers::class, 'guardar']);
$router->post('/api/eliminar', [ApiControllers::class, 'eliminar']);

//servicios

$router->get('/servicios', [ServicioControllers::class, 'index']);

$router->get('/servicios/crear', [ServicioControllers::class, 'crear']);
$router->post('/servicios/crear', [ServicioControllers::class, 'crear']);

$router->get('/servicios/actualizar', [ServicioControllers::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioControllers::class, 'actualizar']);

$router->post('/servicios/eliminar', [ServicioControllers::class, 'eliminar']);

$router->comprobarUrl();