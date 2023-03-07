<?php

require_once(PATH_CLASSES . 'ManageThemes.php');

class AccountPartProfilePresenter
{
    private ManageThemes $manageThemes;

    public function __construct()
    {
        $this->manageThemes = ManageThemes::getInstance();
    }

    public function getAllThemesInSubmitButton(): string
    {
        $themes = $this->manageThemes->getAllThemes();

        $actualThemeName = $_SESSION['user']['theme'];

        $HTML = "";
        foreach ($themes as $theme) {

            $bannerPath = $theme->getDefaultBannerPath();
            $themeName = strtolower($theme->getTheme());

            $backgroundColor = $theme->getBackgroundColor();

            $HTML .= '<button type="submit" name="' . $themeName . '" class="' . $themeName . ' ' . $this->isActiveTheme($actualThemeName, $themeName) . '">';
            $HTML .= '<div class="profile-container">';
            $HTML .= '<img class="profile-banner" src="' . $bannerPath . '" alt="Banner" draggable="false">';
            $HTML .= '<div class="left-profile" style="background:' . $backgroundColor . '">';
            $HTML .= '</div>';
            $HTML .= '<div class="right-profile">';
            $HTML .= '</div>';
            $HTML .= '</div>';
            $HTML .= '</button>';
        }
        return $HTML;
    }

    private function isActiveTheme(string $theme, string $tmp): string
    {
        if ($theme === $tmp) {
            return 'active';
        }
        return '';
    }

    public function getActiveThemeInDiv(): string
    {
        $theme = $this->manageThemes->getActiveTheme();

        $HTML = '<div class="active-theme">';
        $HTML .= '<div class="profile-container">';
        $HTML .= '<img class="profile-banner" src="' . $theme->getBannerPath() . '" alt="Banner" draggable="false">';
        $HTML .= '<div class="left-profile" style="background:' . $theme->getBackgroundColor() . '">';
        $HTML .= '</div>';
        $HTML .= '<div class="right-profile">';
        $HTML .= '</div>';
        $HTML .= '</div>';
        $HTML .= '</div>';

        return $HTML;
    }
}
