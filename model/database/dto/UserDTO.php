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

    public function updateUsername(string $username, int $id): string
    {
        $sql = 'UPDATE user SET username = :username WHERE id = :id';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':id', $id);
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
                return 'username_already_exists';
            } else {
                return 'unknown';
            }
        }
        $_SESSION['user']['username'] = $username;
        return 'success';
    }

    public function updatePassword(string $password, int $id): string
    {
        $sql = 'UPDATE user SET password = :password WHERE id = :id';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(':id', $id);
        try {
            $stmt->execute();
        } catch (PDOException $e) {

            return 'unknown';
        }
        return 'success';
    }

    public function updateProfilePicture($file, $id): bool
    {
        $sql = 'UPDATE user SET profile_picture = :profile_picture WHERE id = :id';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':profile_picture', $file);
        $stmt->bindValue(':id', $id);

        try {
            $stmt->execute();
            $_SESSION['user']['profile_picture'] = $file;
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    public function updateProfile(User $user, string $description, bool $is_public, string $profile_picture): bool
    {
        $sql = 'UPDATE user SET description = :description, profile_picture = :profile_picture, is_public = :is_public WHERE id = :id';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':profile_picture', $profile_picture);
        $stmt->bindValue(':is_public', $is_public);
        $stmt->bindValue(':id', $user->getId());
        try {
            $stmt->execute();
            if (!$user->isDefaultProfilePicture()) {
                unlink($user->getProfilePicturePath());
            }
            $_SESSION['user']['description'] = $description;
            $_SESSION['user']['profile_picture'] = $profile_picture;
            $_SESSION['user']['is_public'] = $is_public;
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
}
