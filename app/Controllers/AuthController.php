<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Controller;
use App\Core\Application;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Models\LoginForm;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $user = new User;
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->register()) {
                Application::$app->session->setFlashMessages('success', 'Your account has been created successfully.');
                Application::$app->response->redirect('/');
                exit;
            }
            return $this->render('signup', [
                'model' => $user
            ]);
        }
        return $this->render('signup', [
            "model" => $user
        ]);
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()) {
                Application::$app->session->setFlashMessages('success', 'Login Successful');
                $response->redirect('/');
                return;
            }
        }
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function logout() : void
    {
        Application::$app->session->remove('user');
        header("Location: /");
        exit;
    }

}