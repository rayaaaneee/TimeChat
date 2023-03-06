<?php

require_once(PATH_CLASSES . 'ProfileTheme.php');
require_once(PATH_DATABASE . 'DTO.php');

class ProfileThemeDTO extends DTO
{
    private static string $table = 'profile_theme';

    public function __construct()
    {
        parent::__construct();
    }

    public function insertOneWithoutBanner(ProfileTheme $profileTheme): bool
    {
        $theme = $profileTheme->getTheme();
        $userId = $profileTheme->getUserId();

        $sql = "INSERT INTO " . self::$table . " (theme, id_user) VALUES (:theme, :id_user)";

        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':theme', $theme);
        $stmt->bindValue(':id_user', $userId);

        return $stmt->execute();
    }

    public function updateOneWithoutBanner(ProfileTheme $profileTheme): bool
    {
        $theme = $profileTheme->getTheme();
        $userId = $profileTheme->getUserId();

        $sql = "UPDATE " . self::$table . " SET theme = :theme WHERE id_user = :id_user";

        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':theme', $theme);
        $stmt->bindValue(':id_user', $userId);

        return $stmt->execute();
    }

    public function insertOneWithBanner(ProfileTheme $profileTheme): bool
    {
        $theme = $profileTheme->getTheme();
        $banner = $profileTheme->getBanner();

        $sql = "INSERT INTO " . self::$table . " (theme, banner) VALUES (:theme, :banner)";

        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':theme', $theme);
        $stmt->bindValue(':banner', $banner);

        return $stmt->execute();
    }
}
