<?php

require_once(PATH_CLASSES . 'ProfileTheme.php');

class ProfileThemeDAO extends DAO
{
    private static string $table = 'profile_theme';

    public function __construct()
    {
        parent::__construct();
    }

    public function getByUserId(string $userId): array
    {
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id_user = :id_user LIMIT 1';
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':id_user', $userId);
        $stmt->execute();
        $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt;
    }
}
