<?php

namespace App\Core;

class View
{
    public function renderView($view)
    {
        include_once __DIR__ . "/../Views/$view.php";
    }
}