<?php

require_once(PATH_APPS . 'saveImage.php');

require_once(PATH_CONTROLLERS . 'account/error/initErrorMessageProfile.php');

require_once(PATH_PRESENTERS . 'AccountPartProfilePresenter.php');


function echoChecked($bool)
{
    if ($bool) {
        echo 'checked';
    }
}

function echoPublic($bool)
{
    if ($bool) {
        echo 'public';
    } else {
        echo 'private';
    }
}

/* Il y a deux case a traiter, si il a update son profil, ou si il a supprimé sa photo
de profil */
if (isset($_POST['remove-profile-picture'])) {
    $succesRemove = $user->removeProfilePicture();
    if ($succesRemove) {
        Header('Location: ./?page=account&part=profile&delete=success');
    } else {
        Header('Location: ./?page=account&part=profile&delete=error');
    }
    exit();
} else if (isset($_POST['update-profile'])) {
    $description = $_POST['description'];
    $isPublic = isset($_POST['is-public']);

    // Il a mit une photo de profil si $_FILES contient un ficheir recent (error != 4)
    $hasSetProfilePicture = isset($_FILES['profile-picture']) && $_FILES['profile-picture']['error'] != 4;

    $profilePicture = $user->getProfilePicture();
    if ($hasSetProfilePicture) {
        $profilePicture = $_FILES['profile-picture']['name'];
    }

    $successUpdate = $user->updateProfile($description, $isPublic, $profilePicture);
    if ($successUpdate) {
        Header('Location: ./?page=account&part=profile&update=success');
    } else {
        Header('Location: ./?page=account&part=profile&update=error');
    }
    exit();
}

// Si l'utilosateur a changé son theme de profil on fait la mise a jour
$themes = ['red', 'black', 'green', 'orange', 'violet', 'yellow'];

foreach ($themes as $theme) {
    if (isset($_POST[$theme . '-theme'])) {
        require_once(PATH_DTO . 'ProfileThemeDTO.php');
        require_once(PATH_CLASSES . 'ProfileTheme.php');

        $profileTheme = new ProfileTheme($theme, null);
        $profileTheme->setUserId($user->getId());
        $profileThemeDTO = new ProfileThemeDTO();

        $successUpdateTheme = $profileThemeDTO->updateOneWithoutBanner($profileTheme);
        if ($successUpdateTheme) {
            $_SESSION['user']['theme'] = $profileTheme->getTheme();
            Header('Location: ./?page=account&part=profile&update=success');
        } else {
            Header('Location: ./?page=account&part=profile&update=error');
        }
    }
}

$profilePresenter = new AccountPartProfilePresenter();
$themeButtons = $profilePresenter->getAllThemesInSubmitButton();

$needsDisplay = isset($_GET['update']) || isset($_GET['delete']) || isset($_GET['upload']);
$isSuccess = IsSuccessProfile();
$returnMessage = initErrorMessageProfile();

$isPublic = $user->isPublic();
