<?php 

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router\Router;
use App\Controllers\InicioController;

$router = new Router();

$router -> get('inicio', InicioController::class, 'index');

$rotaPedida = $_GET['rota'] ?? '';
$verboPedido = $_SERVER['REQUEST_METHOD'];

$router-> despachar($rotaPedida, $verboPedido);