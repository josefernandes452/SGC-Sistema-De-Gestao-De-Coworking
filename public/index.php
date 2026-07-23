<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router\Router;
use App\Controllers\InicioController;
use App\Controllers\AuthController;

$router = new Router();

$router->get('inicio', InicioController::class, 'index');
$router->get('registo', AuthController::class, 'registoFormulario');
$router->post('registo', AuthController::class, 'registar');
$router->get('login', AuthController::class, 'loginFormulario');
$router->post('login', AuthController::class, 'login');

$rotaPedida = $_GET['rota'] ?? '';
$verboPedido = $_SERVER['REQUEST_METHOD'];

$router->despachar($rotaPedida, $verboPedido);