<?php

namespace App\Core;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Models\User;

class Application
{
    public static string $ROOT_PATH;
    public Request $request;
    public Response  $response;
    public static Application $app;
    public Router $router;
    public View $view;
    public Database $db;
    public Session $session;
    public ?User $user;

    /**
     * @throws \Exception
     */
    public function __construct(string $rootPath, array $config)
    {
        self::$ROOT_PATH = $rootPath;
        self::$app = $this;
        $this->request = new Request;
        $this->response = new Response;
        $this->router = new Router($this->request, $this->response);
        $this->view = new View;
        $this->db = new Database($config);
        $this->session = new Session;
        $this->user = new User;
    }

    public function login(User $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $id = $user->{$primaryKey};
        $this->session->set('user', $id);
        return true;
    }

    public function run()
    {
        echo $this->router->resolve();
    }

}