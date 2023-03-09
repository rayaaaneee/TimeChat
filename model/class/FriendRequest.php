<?php

class FriendRequest
{
    private int $senderId;
    private int $receiverId;
    private \DateTime $date;

    public function __construct(int $receiverId, int $senderId = null, \DateTime $date = null)
    {
        if (!$senderId) {
            $this->senderId = $_SESSION['user']['id'];
        } else {
            $this->senderId = $senderId;
        }

        if (!$date) {
            $this->date = new \DateTime("now", new \DateTimeZone('Europe/Paris'));
        } else {
            $this->date = $date;
        }

        $this->receiverId = $receiverId;
    }

    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function getReceiverId(): int
    {
        return $this->receiverId;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }
}
