<?php

namespace App\Models;

use App\Core\DbModel;

class User extends DbModel
{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function getTableName() : string
    {
        return 'users';
    }

    public static function primaryKey() : string
    {
        return 'id';
    }

    public function getAttributes() : array
    {
        return ['firstName', 'lastName', 'email', 'password'];
    }

    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->save();
    }

    public function findUser(string $email)
    {
        $where = ['email' => $email];
        $this->selectRecord($where);
    }

    public function rules() : array
    {
        return [
            "firstName" => [self::RULE_REQUIRED],
            "lastName" => [self::RULE_REQUIRED],
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL],
            "password" => [self::RULE_REQUIRED],
            "confirmPassword" => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function labels() : array
    {
        return [
            "firstName" => "First Name",
            "lastName" => "Last Name",
            "email" => "Email",
            "password" => "Password",
            "confirmPassword" => "Confirm Password",
        ];
    }
}