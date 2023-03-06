<?php

require_once(PATH_CLASSES . 'ManageThemes.php');

class AccountPartProfilePresenter
{
    public function getAllThemesInSubmitButton(): string
    {
        $manageThemes = ManageThemes::getInstance();
        $themes = $manageThemes->getAllThemes();

        $actualThemeName = $_SESSION['user']['profile_theme']['theme'];

        $HTML = "";
        foreach ($themes as $theme) {

            $bannerPath = $theme->getBannerPath();
            $themeName = strtolower($theme->getName());
            $backgroundColor = $theme->getBackgroundColor();

            $HTML .= '<button type="submit" name="' . $themeName . '-theme" class="' . $themeName . ' ' . $this->isActiveTheme($actualThemeName, $themeName) . '">';
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
}
