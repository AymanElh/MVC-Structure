<?php

namespace App\Core\Http;

class Request
{
    public function getPath() : string
    {
            return $_SERVER['REQUEST_URI'] ??  '/';
    }

    public function method() : string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}