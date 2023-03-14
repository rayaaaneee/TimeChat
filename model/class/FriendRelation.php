<?php

class FriendRelation
{
    private int $id;
    /* User 1 is the user with the lowest id */
    private int $idUser1;
    /* User 2 is the user with the highest id */
    private int $idUser2;

    public function __construct(array $ids, int $id = null)
    {
        if ($id != null) {
            $this->id = $id;
        }

        if (count($ids) == 2) {
            if ($ids[0] < $ids[1]) {
                $this->idUser1 = $ids[0];
                $this->idUser2 = $ids[1];
            } else {
                $this->idUser1 = $ids[1];
                $this->idUser2 = $ids[0];
            }
        } else {
            throw new Exception("FriendRelation: Invalid number of ids");
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdUser1(): int
    {
        return $this->idUser1;
    }

    public function getIdUser2(): int
    {
        return $this->idUser2;
    }

    public function getIdFriend(User $user): int
    {
        if ($user->getId() == $this->idUser1) {
            return $this->idUser2;
        } else {
            return $this->idUser1;
        }
    }
}
