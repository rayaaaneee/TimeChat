<?php

require_once(PATH_CLASSES . 'ProfileTheme.php');
require_once(PATH_DTO . 'ProfileThemeDTO.php');

class UserDTO extends DTO
{
    private static string $table = 'user';

    private ProfileThemeDTO $profileThemeDTO;

    public function __construct()
    {
        $this->profileThemeDTO = new ProfileThemeDTO();
        parent::__construct();
    }

    public function signup(User $user): string
    {
        return $this->insertUser($user);
    }

    private function insertUser(User $user): string
    {
        $sql = 'INSERT INTO ' . self::$table . ' (username, password, description, profile_picture, signup_at, is_public) VALUES (:username, :password, :description, :profile_picture, NOW(), :is_public)';
        $stmt = self::$db->prepare($sql);
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

        // On insère dans la table profile_theme le thème par défaut avec l'id de l'utilisateur
        $id = $this->getLastInsertId(self::$table);

        $profileTheme = new ProfileTheme(ProfileTheme::$defaultTheme, null);
        $profileTheme->setUserId($id);

        $user->setId($id);

        if (!$this->profileThemeDTO->insertOneWithoutBanner($profileTheme)) {
            return 'unknown';
        }
        return 'success';
    }

    public function updateQRCode(User $user): bool
    {
        $sql = 'UPDATE ' . self::$table . ' SET qrcode = :qrcode WHERE id = :id';
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':qrcode', $user->getQRCode());
        $stmt->bindValue(':id', $user->getId());
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    public function updateUsername(string $username, int $id): string
    {
        $sql = 'UPDATE ' . self::$table . ' SET username = :username WHERE id = :id';
        $stmt = self::$db->prepare($sql);
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
        $sql = 'UPDATE ' . self::$table . ' SET password = :password WHERE id = :id';
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(':id', $id);
        try {
            $stmt->execute();
        } catch (PDOException $e) {

            return 'unknown';
        }
        return 'success';
    }

    public function updateProfilePicture(string $file, User $user): bool
    {
        $sql = 'UPDATE ' . self::$table . ' SET profile_picture = :profile_picture WHERE id = :id';
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':profile_picture', $file);
        $stmt->bindValue(':id', $user->getId());

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
        $_SESSION['user']['profile_picture'] = $file;
        return true;
    }

    public function updateProfile(User $user, string $newDescription, bool $newIsPublic, string $newProfilePicture): bool
    {
        $sql = 'UPDATE ' . self::$table . ' SET description = :description, profile_picture = :profile_picture, is_public = :is_public WHERE id = :id';
        $stmt = self::$db->prepare($sql);
        $stmt->bindParam(':description', $newDescription);
        $stmt->bindParam(':profile_picture', $newProfilePicture);
        $stmt->bindParam(':is_public', $newIsPublic);
        $stmt->bindParam(':id', $user->getId());

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            unlink(PATH_PROFILE_PICTURES . $newProfilePicture);
            return false;
        }

        $_SESSION['user']['description'] = $newDescription;
        $_SESSION['user']['profile_picture'] = $newProfilePicture;
        $_SESSION['user']['is_public'] = $newIsPublic;

        $oldPicture = $user->getProfilePicture();
        if (!$user->isDefaultProfilePicture() && $oldPicture !== $newProfilePicture) {
            unlink($user->getProfilePicturePath());
        }
        return true;
    }

    public function updateDescription(string $description, int $id): bool
    {
        $sql = 'UPDATE ' . self::$table . ' SET description = :description WHERE id = :id';
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':id', $id);
        try {
            $stmt->execute();
            $_SESSION['user']['description'] = $description;
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    public function updateIsPublic(bool $is_public, int $id): bool
    {
        $sql = 'UPDATE ' . self::$table . ' SET is_public = :is_public WHERE id = :id';
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':is_public', $is_public);
        $stmt->bindValue(':id', $id);
        try {
            $stmt->execute();
            $_SESSION['user']['is_public'] = $is_public;
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
}
