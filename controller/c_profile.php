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
        $profileUserTab = $userTab['user'];
        $profileUserTheme = $userTab['theme'];
        $themeName = $profileUserTheme['theme'];
        $banner = $profileUserTheme['banner'];

        // On transforme le tableau en objet User
        $profileUser = new User($profileUserTab['username'], $profileUserTab['password'], $profileUserTab['description'], $profileUserTab['profile_picture'], $profileUserTab['is_public'], new DateTime($profileUserTab['signup_at']), $profileUserTab['id']);

        // On ajoute le theme de profil
        $ManageThemes = ManageThemes::getInstance();
        $profileTheme = $ManageThemes->getThemeByColor($themeName);
        $profileUser->setProfileTheme($profileTheme);
        if ($banner) {
            $profileUser->setBanner($banner);
        }
    }
} else {
    header('Location: ./');
    exit();
}
require_once(PATH_VIEWS . 'header.php');

require_once(PATH_VIEWS . 'profile.php');

require_once(PATH_VIEWS . 'footer.php');
