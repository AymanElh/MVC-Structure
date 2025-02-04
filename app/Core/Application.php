<?php

namespace App\Core;

use App\Core\Http\Request;
use App\Core\Http\Response;

class Application
{
    public static string $ROOT_PATH;
    public Request $request;
    public Response  $response;
    public static Application $app;
    public Router $router;
    public View $view;
    public Database $db;
    public function __construct(string $rootPath, array $config)
    {
        self::$app = $this;
        $this->request = new Request;
        $this->response = new Response;
        $this->router = new Router($this->request, $this->response);
        $this->view = new View;
        $this->db = new Database($config);
        self::$ROOT_PATH = $rootPath;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}