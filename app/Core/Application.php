<?php

namespace App\Core;

use App\Core\Http\Request;
use App\Core\Http\Response;

class Application
{
    public Request $request;
    public Response  $response;
    public static Application $app;
    public Router $router;
    public View $view;
    public function __construct()
    {
        self::$app = $this;
        $this->request = new Request;
        $this->response = new Response;
        $this->router = new Router($this->request, $this->response);
        $this->view = new View;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}