<?php

class UserDAO extends DAO
{
    public function signin(User $user): ?array
    {
        $sql = 'SELECT * FROM user WHERE username = :username AND password = :password';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        }
        return null;
    }

    public function signout(): void
    {
        unset($_SESSION['user']);
    }
}
