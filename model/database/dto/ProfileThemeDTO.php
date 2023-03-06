<?php

require_once(PATH_CLASSES . 'ProfileTheme.php');
require_once(PATH_DATABASE . 'DTO.php');

class ProfileThemeDTO extends DTO
{
    private static string $table = 'profile_theme';

    public function insertOneWithoutBanner(ProfileTheme $profileTheme): bool
    {
        $theme = $profileTheme->getTheme();

        $sql = "INSERT INTO " . self::$table . " (theme) VALUES (:theme)";

        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':theme', $theme);

        return $stmt->execute();
    }

    public function insertOneWithBanner(ProfileTheme $profileTheme): bool
    {
        $theme = $profileTheme->getTheme();
        $banner = $profileTheme->getBanner();

        $sql = "INSERT INTO " . self::$table . " (theme, banner) VALUES (:theme, :banner)";

        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':theme', $theme);
        $stmt->bindValue(':banner', $banner);

        return $stmt->execute();
    }
}
