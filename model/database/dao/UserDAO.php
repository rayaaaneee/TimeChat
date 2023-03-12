<?php

require_once(PATH_DAO . 'ProfileThemeDAO.php');
class UserDAO extends DAO
{
    private static string $table = 'user';
    private ProfileThemeDAO $profileThemeDAO;

    public function __construct()
    {
        parent::__construct();
        $this->profileThemeDAO = new ProfileThemeDAO();
    }

    public function signin(User $user): array
    {
        $sql = 'SELECT password from ' . self::$table . ' WHERE username = :username';
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->execute();
        $hashPassword = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($hashPassword) {
            if (password_verify($user->getPassword(), $hashPassword['password'])) {
                $sql = 'SELECT * FROM user WHERE username = :username';
                $stmt = self::$db->prepare($sql);
                $stmt->bindValue(':username', $user->getUsername());

                try {
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user'] = $result;

                $idUser = $result['id'];
                $userProfileTheme = $this->profileThemeDAO->getByUserId($idUser);

                if (!$userProfileTheme) {
                    return [0, 'profile_theme'];
                }

                $_SESSION['user']['theme'] = $userProfileTheme['theme'];
                $_SESSION['user']['banner'] = $userProfileTheme['banner'];
                return [1, $result];
            } else {
                return [0, 'password', $user->getUsername()];
            }
        }
        return [0, 'username', $user->getUsername()];
    }

    public function signout(): void
    {
        unset($_SESSION['user']);
    }

    public function verifyPassword(User $user, string $password): bool
    {
        $result = false;

        $sql = 'SELECT password FROM ' . self::$table . ' WHERE username = :username';
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->execute();
        $hashPassword = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($hashPassword) {
            if (password_verify($password, $hashPassword['password'])) {
                $result =  true;
            }
        }
        return $result;
    }

    public function getUserAndProfileThemeById(string $id): array
    {
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $profileTheme = $this->profileThemeDAO->getByUserId($id);

        $userAndProfileTheme = [
            'user' => $result,
            'theme' => $profileTheme
        ];

        return $userAndProfileTheme;
    }

    public static function getUsersByIds(array $ids): array
    {
        $users = array();
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id IN (' . implode(',', $ids) . ')';
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // On garde l'ordre des ids du tableau fourni en paramètre
        foreach ($ids as $id) {
            foreach ($result as $user) {
                if ($user['id'] == $id) {
                    $tmp_user = new User($user['username'], null, null, $user['profile_picture'], $user['is_public']);
                    $tmp_user->setId($user['id']);
                    $users[] = $tmp_user;
                }
            }
        }

        return $users;
    }
}
