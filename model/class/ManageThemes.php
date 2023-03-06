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
            $backgroundColor = $theme['backgroundColor'];
            $bannerName = $theme['banner'];

            // On crée un objet Theme
            $theme = new Theme($name, $backgroundColor, $bannerName);

            // On ajoute le thème dans le tableau
            $this->themes[$i] = $theme;

            $i++;
        }
    }

    public function getAllThemes(): array
    {
        return $this->themes;
    }

    public function getThemeByColor(string $color): array
    {
        $themes = [];
        if (isset($this->themes[$color])) {
            $themes = $this->themes[$color];
        }
        return $themes;
    }

    public static function getInstance(): ManageThemes
    {
        if (self::$instance == null) {
            self::$instance = new ManageThemes();
        }
        return self::$instance;
    }
}
