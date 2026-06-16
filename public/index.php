<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\HomeController;
use App\Core\Database;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router = new Router();

// Home Route
$router->get('/', [HomeController::class, 'index']);

// Database Connection Test Route
$router->get('/test-db', function () {
    try {
        Database::connect();
        echo "Database connected successfully!";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
});

// Dispatch LAST
$router->dispatch(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);