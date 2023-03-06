<?php

require_once(PATH_APPS . 'goSigninIfNotConnected.php');

require_once(PATH_DAO . 'UserDAO.php');

require_once(PATH_CLASSES . 'ManageThemes.php');

require_once(PATH_PRESENTERS . 'ProfilePresenter.php');
$display = new ProfilePresenter();

$profileUser = null;

if (isset($_GET['user']) && $_GET['user'] != null) {
    if ($_GET['user'] == $_SESSION['user']['id']) {
        header('Location: ./?page=myprofile');
        exit();
    }
    $UserDAO = new UserDAO();
    $userTab = $UserDAO->getUserAndProfileThemeById($_GET['user']);

    if ($userTab != null) {
        $profileUser = $userTab['user'];
        $profileTheme = $userTab['theme'];
        $theme = $profileTheme['theme'];
        $banner = $profileTheme['banner'];

        // On transforme le tableau en objet User
        $profileUser = new User($profileUser['username'], $profileUser['password'], $profileUser['description'], $profileUser['profile_picture'], $profileUser['is_public'], new DateTime($profileUser['signup_at']), $profileUser['id']);

        // On ajoute le theme de profil
        $ManageThemes = ManageThemes::getInstance();
        $profileTheme = $ManageThemes->getThemeByColor($theme);
        $profileUser->setProfileTheme($profileTheme);
    }
} else {
    header('Location: ./');
    exit();
}
require_once(PATH_VIEWS . 'header.php');

require_once(PATH_VIEWS . 'profile.php');

require_once(PATH_VIEWS . 'footer.php');
