<?php

class DAO
{

    public static PDO $db;

    public function __construct()
    {
        self::$db = Connection::getInstance()->getPDO();
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function findAll(string $table): array
    {
        $sql = 'SELECT * FROM ' . $table;
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stmt;
    }

    public function findOneById(string $table, int $id): array
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE id = :id LIMIT 1';
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt;
    }

    public function findOneBy(string $table, string $column, string $value): array
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $column . ' = :' . $column . ' LIMIT 1';
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':' . $column, $value);
        $stmt->execute();
        $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt;
    }
}
