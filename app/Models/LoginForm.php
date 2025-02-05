<?php

namespace App\Models;

use App\Core\DbModel;
use App\Core\Application;


class LoginForm extends DbModel
{
    public string $email = '';
    public string $password = '';

    public function getTableName(): string
    {
        return 'users';
    }

    public function getAttributes() : array
    {
        return ["email", "password"];
    }

    public function rules() : array
    {
        return [
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL],
            "password" => [self::RULE_REQUIRED]
        ];
    }


    public function labels() : array
    {
        return [
            'email' => 'Your Email',
            'password' => 'Your Password'
        ];
    }

    public function login() {
        $user = User::findOne(['email' => $this->email]);

        if(!$user) {
            $this->createErrorMessage('email', 'User not Found');
            return false;
        }

        if(!password_verify($this->password, $user->password)) {
            $this->createErrorMessage('password', 'Password is incorrect');
            return false;
        }

        return Application::$app->login($user);
    }

}