<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Application;


$app = new Application();

$app->router->get('/', function () {
    echo "hello world";
});

$app->router->get('/article', function () {
    echo "article page";
});

$app->router->get('/about', function () {
    echo "about page";
});

$app->run();
