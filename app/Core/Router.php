<?php

namespace App\Core;

use App\Core\Http\Request;
use App\Core\Http\Response;

class Router
{
    public array $routes = [];

    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, $callback) : void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback) : void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if(!$callback) {
            return "Not found";
        }

        if(is_string($callback)) {
            Application::$app->view->renderView($callback);
        }

        if(is_array($callback)) {
            $callback[0] = new $callback[0];
        }
        return call_user_func($callback, $this->request, $this->response);
    }
}