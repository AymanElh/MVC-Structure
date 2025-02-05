<?php

namespace App\Core;

abstract class DbModel extends Model
{
    abstract public function getTableName();
    abstract public function getAttributes();

    public function save()
    {
        $table = $this->getTableName();
        $attributes = $this->getAttributes();
        $columns = implode(',', $attributes);
        $placeholders = implode(',', array_fill(0, count($attributes), '?'));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders);";
        $stmt = $this->prepare($sql);
        $values = [];
        foreach($attributes as $attribute) {
            $values[] = $this->{$attribute};
        }
        return $stmt->execute($values);
    }

    public static function findOne(array $where)
    {
        $tableName = (new static)->getTableName();
        $attributes = array_keys($where);
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $stmt = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach($where as $key => $item) {
            $stmt->bindValue(":$key", $item);
        }
        $stmt->execute();
        return $stmt->fetchObject(static::class);
    }

    public static function prepare($sql)
    {
        return Application::$app->db->conn->prepare($sql);
    }

}