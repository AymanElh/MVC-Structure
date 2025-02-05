<?php

namespace App\migrations;
use App\Core\Application;

class m001
{
    public function up()
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            firstName VARCHAR(30) NOT NULL,
            lastName VARCHAR(30) NOT NULL,
            email VARCHAR(50) NOT NULL,
            password VARCHAR(50) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";
        $db->exec($sql);
    }

    public function down()
    {
       $db = Application::$app->db;
       $db->exec("DROP TABLE users;");
    }
}