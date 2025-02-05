<?php

namespace App\Models;
use App\Core\DbModel;
class Article extends DbModel
{
    public string $title = '';
    public string $content = '';
    public string $author = '';
    public string $created_at = '';

    public function getTableName(): string
    {
        return 'articles';
    }

    public function getAttributes(): array
    {
        return ['title', 'content', 'author', 'created_at'];
    }

    public function rules() : array
    {
        return [];
    }

    public static function getAll() : array
    {
        $tableName = 'articles';
        $sql = "SELECT * FROM $tableName ORDER BY created_at DESC";
        $stmt = self::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}