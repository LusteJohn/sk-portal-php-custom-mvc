<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\SkElectionController;
use App\Controllers\PartylistController;
use App\Controllers\CandidateController;
use App\Controllers\EducationController;
use App\Controllers\CandidateProfileController;
use App\Controllers\CandidateProgramController;
use App\Controllers\CandidateSessionController;

use App\Middleware\AdminMiddleware;
use App\Middleware\MemberMiddleware;

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

// Users Routes
$router->get('/admin/dashboard', [HomeController::class, 'dashboard']);
$router->get('/member/dashboard', [HomeController::class, 'memberDashboard']);
$router->get('/viewer/dashboard', [HomeController::class, 'viewerDashboard']);

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

$router->get('/admin/candidate', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new CandidateController())->index();
});

$router->post('/admin/candidate/store', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new CandidateController())->store();
});

$router->get('/admin/candidate/edit', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new CandidateController())->edit();
});

$router->post('/admin/candidate/update', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new CandidateController())->update();
});

$router->post('/admin/candidate/delete', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new CandidateController())->delete();
});

$router->get('/admin/education', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new EducationController())->index();
});

$router->post('/admin/education/store', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new EducationController())->store();
});

$router->get('/admin/education/edit', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new EducationController())->edit();
});

$router->post('/admin/education/update', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new EducationController())->update();
});

$router->post('/admin/education/delete', function () {
    \App\Middleware\AdminMiddleware::handle();
    (new EducationController())->delete();
});

// for member routes

$router->get('/member/candidate-member', function () {
    MemberMiddleware::handle();
    (new CandidateController())->memberProfile();
});

$router->post('/member/candidate/update', function () {
    MemberMiddleware::handle();
    (new CandidateController())->memberUpdate();
});

$router->post('/member/candidate/delete', function () {
    MemberMiddleware::handle();
    (new CandidateController())->memberDelete();
});

// Candidate Profile Routes
$router->get('/member/candidate-profile', function () {
    MemberMiddleware::handle();
    (new CandidateProfileController())->memberProfileView();
});

$router->post('/member/candidate-profile/store', function () {
    MemberMiddleware::handle();
    (new CandidateProfileController())->memberProfileStore();
});

// Candidate Program Routes
$router->get('/member/candidate-programs', function () {
    MemberMiddleware::handle();
    (new CandidateProgramController())->memberProgramView();
});

$router->post('/member/candidate-programs/store', function () {
    MemberMiddleware::handle();
    (new CandidateProgramController())->memberProgramStore();
});

// Candidate Session Routes
$router->get('/member/candidate-sessions', function () {
    MemberMiddleware::handle();
    (new CandidateSessionController())->memberSessionView();
});

$router->post('/member/candidate-sessions/store', function () {
    MemberMiddleware::handle();
    (new CandidateSessionController())->memberSessionStore();
});

$router->post('/member/education/store', function () {
    MemberMiddleware::handle();
    (new EducationController())->memberStore();
});

$router->post('/member/education/update', function () {
    MemberMiddleware::handle();
    (new EducationController())->memberUpdate();
});

$router->post('/member/education/delete', function () {
    MemberMiddleware::handle();
    (new EducationController())->memberDelete();
});

// Dispatch LAST
$router->dispatch(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);