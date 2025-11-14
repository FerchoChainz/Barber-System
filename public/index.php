<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;

$router = new Router();


// LOGIN
$router->get('/',[LoginController::class, 'login']);
$router->post('/',[LoginController::class, 'login']);
$router->get('/logout',[LoginController::class, 'logout']);

// recover password
$router->get('/forget',[LoginController::class, 'forgetPassword']);
$router->post('/forget',[LoginController::class, 'forgetPassword']);
$router->get('/recover',[LoginController::class, 'recoverPassword']);
$router->post('/recover',[LoginController::class, 'recoverPassword']);

// Create Accoutn
$router->get('/create-account', [LoginController::class,'createAccount']);
$router->post('/create-account', [LoginController::class,'createAccount']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->checkRoutes();