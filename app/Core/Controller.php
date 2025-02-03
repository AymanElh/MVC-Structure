<?php

namespace App\Core;

use App\Core\Application;

class Controller
{
    public function render($view)
    {
        Application::$app->view->renderView($view);
    }
}