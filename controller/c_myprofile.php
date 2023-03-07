<?php

require_once(PATH_APPS . 'goSigninIfNotConnected.php');

require_once(PATH_PRESENTERS . 'ProfilePresenter.php');
$display = new ProfilePresenter();

require_once(PATH_CLASSES . 'ProfileTheme.php');
require_once(PATH_CLASSES . 'ManageThemes.php');

$theme = $_SESSION['user']['theme'];

$manageThemes = ManageThemes::getInstance();
$profileTheme = $manageThemes->getThemeByColor($theme);
$user->setProfileTheme($profileTheme);

if ($_SESSION['user']['banner'] != ProfileTheme::$defaultBanner) {
    $profileTheme->setBanner($_SESSION['user']['banner']);
}

require_once(PATH_VIEWS . 'header.php');

require_once(PATH_VIEWS . 'myprofile.php');

require_once(PATH_VIEWS . 'footer.php');
