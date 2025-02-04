<?php

namespace App\Core;


class Database
{
    public \PDO $conn;

    public function __construct(array $config)
    {
        try {
            $dsn = $config['db']['dsn'] ?? '';
            $user = $config['db']['user'] ?? '';
            $password = $config['db']['password'] ?? '';
            $this->conn = new \PDO($dsn, $user, $password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function createMigrationTable()
    {
        $sql = "CREATE TABLE migrations (
            id SERIAL INT PRIMARY KEY,
            migration VARCHAR(255),
            create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    }

    public function applyMigration()
    {
        $this->getAppliedMigrations();
    }

    public function getAppliedMigrations()
    {
        $sql = "SELECT migration FROM migrations";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }
}