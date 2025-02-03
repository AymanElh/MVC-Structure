<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Application;
use App\Controllers\HomeController;

$app = new Application();

$app->router->get('/', [HomeController::class, 'home']);
$app->router->get('/about', [HomeController::class, 'about']);


$app->run();
