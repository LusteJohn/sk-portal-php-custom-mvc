<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\SkElectionController;
use App\Controllers\PartylistController;

use App\Middleware\AdminMiddleware;
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

// Dashboard Routes
$router->get('/admin/dashboard', [HomeController::class, 'dashboard']);

// Admin Routes
$router->get('/admin/election-setting', function () {

    \App\Middleware\AdminMiddleware::handle();

    $controller = new \App\Controllers\SkElectionController();
    return $controller->index();
});

$router->post('/admin/election-setting/store', function () {

    \App\Middleware\AdminMiddleware::handle();

    $controller = new \App\Controllers\SkElectionController();
    return $controller->store();
});

$router->post('/admin/election-setting/delete', function () {

    \App\Middleware\AdminMiddleware::handle();

    $controller = new \App\Controllers\SkElectionController();
    return $controller->delete();
});

$router->get('/admin/election-setting/edit', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new \App\Controllers\SkElectionController())->edit();
});

$router->post('/admin/election-setting/update', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new \App\Controllers\SkElectionController())->update();
});

$router->get('/admin/partylist', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new PartylistController())->index();
});

$router->post('/admin/partylist/store', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new PartylistController())->store();
});

$router->get('/admin/partylist/edit', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new PartylistController())->edit();
});

$router->post('/admin/partylist/update', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new PartylistController())->update();
});

$router->post('/admin/partylist/delete', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new PartylistController())->delete();
});

// Dispatch LAST
$router->dispatch(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);