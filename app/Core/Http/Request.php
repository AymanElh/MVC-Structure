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

    public function isGet() : bool
    {
        return $this->method() === 'get';
    }

    public function isPost() : bool
    {
        return $this->method() === 'post';
    }

    public function getBody() : array
    {
        $body = [];
        if($this->method() === 'get') {
            foreach($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if($this->method() === 'post') {
            foreach($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}