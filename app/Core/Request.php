<?php

namespace App\Core;

class Request
{
    public function getPath()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}