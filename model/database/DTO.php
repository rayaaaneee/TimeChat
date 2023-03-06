<?php

class DTO
{

    public static PDO $db;

    public function __construct()
    {
        self::$db = Connection::getInstance()->getPDO();
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function insert(string $table, array $data): bool
    {
        $sql = 'INSERT INTO ' . $table . ' (';
        $sql .= implode(', ', array_keys($data));
        $sql .= ') VALUES (';
        $sql .= ':' . implode(', :', array_keys($data));
        $sql .= ')';
        $stmt = self::$db->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        return $stmt->execute();
    }

    public function update(string $table, array $data, int $id): bool
    {
        $sql = 'UPDATE ' . $table . ' SET ';
        $sql .= implode(' = :', array_keys($data));
        $sql .= ' = :' . implode(', :', array_keys($data));
        $sql .= ' WHERE id = :id';
        $stmt = self::$db->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function delete(string $table, int $id): bool
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE id = :id';
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function getLastInsertId(string $table): int
    {
        $sql = 'SELECT LAST_INSERT_ID() AS id FROM ' . $table;
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }
}
