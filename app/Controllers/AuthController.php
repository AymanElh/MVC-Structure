<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Controller;
use App\Core\Application;
use App\Core\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        $this->render('login');
    }

    public function signup(Request $request)
    {
        $user = new User;
        if($request->isPost()) {
            $user->loadData($request->getBody());
            if($user->validate() && $user->register()) {
                echo  "User Added Successfully";
//                Application::$app->response->redirect('/');
//                exit;
            }
            return $this->render('signup', [
                'model' => $user
            ]);
        }
        return $this->render('signup', [
            "model" => $user
        ]);
    }
}