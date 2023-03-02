<?php

class DTO
{

    private PDO $db;

    public function __construct()
    {
        $this->db = Connection::getInstance()->getPDO();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function insert(string $table, array $data): bool
    {
        $sql = 'INSERT INTO ' . $table . ' (';
        $sql .= implode(', ', array_keys($data));
        $sql .= ') VALUES (';
        $sql .= ':' . implode(', :', array_keys($data));
        $sql .= ')';
        $stmt = $this->db->prepare($sql);
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
        $stmt = $this->db->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function delete(string $table, int $id): bool
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function getPDO(): PDO
    {
        return $this->db;
    }
}
