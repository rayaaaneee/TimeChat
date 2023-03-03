<?php

class UserDTO extends DTO
{
    public function signup(User $user): string
    {
        return $this->insertUser($user);
    }

    private function insertUser($user): string
    {
        $sql = 'INSERT INTO user (username, password, description, profile_picture, signup_at, is_public) VALUES (:username, :password, :description, :profile_picture, NOW(), :is_public)';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT));
        $stmt->bindValue(':description', $user->getDescription());
        $stmt->bindValue(':profile_picture', $user->getProfilePicture());
        $stmt->bindValue(':is_public', $user->isPublic());

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            // Récuperer les erreurs de la base de données MySQL
            $errorInfo = $stmt->errorInfo();
            // Récuperer le code d'erreur
            $errorCode = $errorInfo[1];
            // Récuperer le message d'erreur
            $errorMessage = $errorInfo[2];
            // Si le code d'erreur est 1062, c'est que l'utilisateur existe déjà
            if ($errorCode === 1062) {
                return 'username';
            } else {
                return 'unknown';
            }
        }
        return 'success';
    }
}
