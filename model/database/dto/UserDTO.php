<?php

class UserDTO extends DTO
{
    public function signup(User $user): bool
    {
        $this->insertUser($user);
        return true;
        return false;
    }

    private function insertUser($user)
    {
        $sql = 'INSERT INTO user (username, password, description, profile_picture_path, signup_at, is_public) VALUES (:username, :password, :description, :profile_picture_path, NOW(), :is_public)';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT));
        $stmt->bindValue(':description', $user->getDescription());
        $stmt->bindValue(':profile_picture_path', $user->getProfilePicture());
        $stmt->bindValue(':is_public', $user->isPublic());
        $stmt->execute();
    }
}
