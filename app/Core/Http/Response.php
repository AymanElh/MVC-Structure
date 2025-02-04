<?php

namespace App\Core\Http;

class Response
{
    public function redirect(string $path)
    {
        header('Location: ' . $path);
    }
}