<?php 

require_once __DIR__ . "/../includes/app.php";

use Controllers\LoginControllers;
use MVC\Router;

$router = new Router();
//crear cuentas

$router->get('/crear_cuenta', [LoginControllers::class, 'crear_cuenta']);
$router->post('/crear_cuenta', [LoginControllers::class, 'crear_cuenta']);

//iniciar sesion

$router->get('/', [LoginControllers::class, 'login']);
$router->post('/', [LoginControllers::class, 'login']);
$router->get('/logout', [LoginControllers::class, 'logout']);

//recuperar password

$router->get('/recover_pass', [LoginControllers::class, 'recuperarPass']);
$router->post('/recover_pass', [LoginControllers::class, 'recuperarPass']);

$router->get('/recover', [LoginControllers::class, 'recuperar']);
$router->post('/recover', [LoginControllers::class, 'recuperar']);


$router->comprobarUrl();