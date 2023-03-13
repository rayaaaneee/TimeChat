<?php

class FriendRelation
{
    private int $id;
    private int $idUser1;
    private int $idUser2;

    public function __construct(int $idUser1, int $idUser2, int $id = null)
    {
        $this->idUser1 = $idUser1;
        $this->idUser2 = $idUser2;

        if ($id != null) {
            $this->id = $id;
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
