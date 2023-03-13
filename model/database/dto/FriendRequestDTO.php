<?php

require_once(PATH_DATABASE . 'DTO.php');

class FriendRequestDTO extends DTO
{
    public static string $table = 'friend_request';

    public function __construct()
    {
        parent::__construct();
    }

    public function insertFriendRequest(FriendRequest $friendRequest): bool
    {
        $data = [
            'sender_id' => $friendRequest->getSenderId(),
            'receiver_id' => $friendRequest->getReceiverId(),
            'date' => $friendRequest->getDate()->format('Y-m-d H:i:s')
        ];
        $result = false;
        try {
            $result = $this->insert(self::$table, $data);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $result = false;
            }
        }
        return $result;
    }

    public static function removeOne(FriendRequest $friendRequest): string
    {
        $sql = "DELETE FROM " . self::$table . " WHERE sender_id = :sender_id AND receiver_id = :receiver_id";
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':sender_id', $friendRequest->getSenderId());
        $stmt->bindValue(':receiver_id', $friendRequest->getReceiverId());
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return "unknown";
        }
        if ($stmt->rowCount() > 0) {
            return "success";
        } else {
            return "not-found";
        }
    }

    public static function removeOneByIdSenderAndIdReceiver(FriendRequest $friendRequest): bool
    {
        $sql = "DELETE FROM " . self::$table . " WHERE sender_id = :sender_id AND receiver_id = :receiver_id";
        $stmt = self::$db->prepare($sql);

        $sender = $friendRequest->getSenderId();
        $receiver = $friendRequest->getReceiverId();

        $stmt->bindValue(':sender_id', $sender);
        $stmt->bindValue(':receiver_id', $receiver);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
