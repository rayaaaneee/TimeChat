<?php

require_once(PATH_CLASSES . 'Theme.php');

class ManageThemes
{
    private static $instance = null;
    private array $themes = [];

    private function __construct()
    {
        // On lit le fichier JSON
        $json = file_get_contents(PATH_DATAS . 'theme.json');
        // On le décode
        $themes = json_decode($json, true);

        // On parcours les thèmes
        $i = 0;
        foreach ($themes as $theme) {
            // On récupère les informations du thème
            $name = $theme['name'];
            $bannerName = $theme['banner'];
            $backgroundColor = $theme['backgroundColor'];
            $cornerColor = $theme['cornerColor'];

            // On crée un objet Theme
            $userId = $_SESSION['user']['id'];
            $theme = new ProfileTheme($name, $bannerName, $backgroundColor, $cornerColor, $userId);

            // On ajoute le thème dans le tableau
            $this->themes[$i] = $theme;

            $i++;
        }
    }

    public function getAllThemes(): array
    {
        return $this->themes;
    }

    public function getThemeByColor(string $color): ProfileTheme
    {
        foreach ($this->themes as $theme) {
            if ($theme->getTheme() == $color) {
                return $theme;
            }
        }
        return $this->themes[0];
    }

    public static function getInstance(): ManageThemes
    {
        if (self::$instance == null) {
            self::$instance = new ManageThemes();
        }
        return self::$instance;
    }
}
