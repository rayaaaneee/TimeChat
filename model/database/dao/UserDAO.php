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

    public function signup(User $user): bool
    {
        $sql = 'INSERT INTO user (username, password) VALUES (:username, :password)';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':email', $user->getUsername());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $_SESSION['user'] = $result;
            return true;
        }
        return false;
    }

    public function signout(): void
    {
        session_destroy();
    }
}
