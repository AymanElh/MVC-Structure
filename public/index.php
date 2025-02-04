<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Application;
use App\Controllers\HomeController;
use App\Controllers\AuthController;

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [HomeController::class, 'home']);
$app->router->get('/about', [HomeController::class, 'about']);

$app->router->get('/signup', [AuthController::class, 'signup']);
$app->router->post('/signup', [AuthController::class, 'signup']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->run();
