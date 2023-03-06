<?php

require_once(PATH_CLASSES . 'ManageThemes.php');

class AccountPartProfilePresenter
{
    public function getAllThemesInSubmitButton(): string
    {
        $manageThemes = ManageThemes::getInstance();
        $themes = $manageThemes->getAllThemes();

        $HTML = "";
        foreach ($themes as $theme) {

            $bannerPath = $theme->getBannerPath();
            $themeName = strtolower($theme->getName());
            $backgroundColor = $theme->getBackgroundColor();

            $HTML .= '<button type="submit" name="' . $themeName . '-theme" class="' . $themeName . '">';
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
}
