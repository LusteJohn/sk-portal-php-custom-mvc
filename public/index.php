<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Core\Database;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router = new Router();

// Login Route
$router->get('/', [AuthController::class, 'showLogin']);

// Database Connection Test Route
$router->get('/test-db', function () {
    try {
        Database::connect();
        echo "Database connected successfully!";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
});

$router->get('/login', [AuthController::class, 'showLogin']);
$router->get('/register', [AuthController::class, 'showRegister']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/logout', [AuthController::class, 'logout']);

// Dispatch LAST
$router->dispatch(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);