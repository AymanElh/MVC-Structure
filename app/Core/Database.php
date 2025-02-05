<?php

namespace App\Core;

/**
 * @method exec(string $sql)
 */
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
            throw new \Exception("Database connection failed");
        }
    }

    public function createMigrationsTable()
    {
        $this->conn->exec("CREATE TABLE IF NOT EXISTS migrations (
            id SERIAL PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );");
    }

    public function applyMigration()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_PATH . '/app/migrations');
        $notAppliedMigrations = array_diff($files, $appliedMigrations);

        foreach($notAppliedMigrations as $migration) {
            if($migration === '.' || $migration === '..') { continue; }
            require_once Application::$ROOT_PATH . '/app/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $namespace = "App\\Migrations\\" . $className;

            $instance = new $namespace();
            echo "Applying migration: $migration" . PHP_EOL;
            $instance->up();
            echo "Applied migration: $migration" . PHP_EOL;
            $newMigrations[] = $migration;
        }
        if(!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            echo "All migrations are applied";
        }
    }

    public function getAppliedMigrations() : array
    {
        $stmt = $this->conn->prepare("SELECT migration FROM migrations;");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {

        $stmt = $this->conn->prepare("INSERT INTO migrations (migration) VALUES (:migration);");
        foreach($migrations as $migration) {
            $stmt->execute(['migration' => $migration]);
        }
    }
}