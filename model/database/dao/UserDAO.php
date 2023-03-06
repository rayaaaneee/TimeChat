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
                } else {
                    $_SESSION['user']['profile_theme'] = $userProfileTheme;
                }

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
}
