<?php

require_once(PATH_CLASSES . 'FriendRelation.php');

class FriendRelationDAO extends DAO
{

    public static string $table = 'friend';

    public function __construct()
    {
        parent::__construct();
    }

    public static function alreadyExists(FriendRelation $relation)
    {
        $query = 'SELECT * FROM ' . self::$table . ' WHERE (id_user_1 = :id_user_1 AND id_user_2 = :id_user_2) OR (id_user_1 = :id_user_2 AND id_user_2 = :id_user_1)';
        $stmt = self::$db->prepare($query);

        $id_user_1 = $relation->getIdUser1();
        $id_user_2 = $relation->getIdUser2();
        $stmt->bindValue(':id_user_1', $id_user_1);
        $stmt->bindValue(':id_user_2', $id_user_2);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public static function getFriends(User $user): array
    {
        $query = 'SELECT * FROM ' . self::$table . ' WHERE id_user_1 = :id_user_1 OR id_user_2 = :id_user_2';
        $stmt = self::$db->prepare($query);

        $id_user = $user->getId();

        $stmt->bindValue(':id_user_1', $id_user, PDO::PARAM_INT);
        $stmt->bindValue(':id_user_2', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        $friends = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $friend = new FriendRelation($row['id_user_1'], $row['id_user_2'], $row['id']);
            $friends[] = $friend;
        }

        return $friends;
    }
}
