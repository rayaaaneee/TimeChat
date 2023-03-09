<?php

require_once(PATH_CLASSES . 'FriendRequest.php');
require_once(PATH_DATABASE . 'DAO.php');

class FriendRequestDAO extends DAO
{
    public static string $table = 'friend_request';

    public function getAllFriendRequestsBySender($id): array
    {
        $sql = 'SELECT * FROM ' . self::$table  . ' WHERE sender_id = :id';
        $stmt = DAO::$db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->processRow($res);
    }

    public function processRow(array $array): array
    {
        $requests = array();
        foreach ($array as $friendRequest) {
            $friendRequest = new FriendRequest($friendRequest['receiver_id'], $friendRequest['sender_id'], new DateTime($friendRequest['date']));
            $requests[] = $friendRequest;
        }
        return $requests;
    }
}
