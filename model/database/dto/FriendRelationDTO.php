<?php

require_once(PATH_DAO . 'FriendRelationDAO.php');

class FriendRelationDTO extends DTO
{
    public static string $table = 'friend';

    public static function insertOne(FriendRelation $friendRelation): bool
    {
        $query = 'INSERT INTO ' . self::$table . ' (id_user_1, id_user_2) VALUES (:id_user_1, :id_user_2)';

        $stmt = self::$db->prepare($query);

        $stmt->bindValue(':id_user_1', $friendRelation->getIdUser1(), PDO::PARAM_INT);
        $stmt->bindValue(':id_user_2', $friendRelation->getIdUser2(), PDO::PARAM_INT);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
}
