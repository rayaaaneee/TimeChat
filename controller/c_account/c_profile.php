<?php

require_once(PATH_APPS . 'saveImage.php');

require_once(PATH_CONTROLLERS . 'account/error/initErrorMessageProfile.php');

require_once(PATH_PRESENTERS . 'AccountPartProfilePresenter.php');

$profilePresenter = new AccountPartProfilePresenter();
$profileTheme = ManageThemes::getInstance()->getThemeByColor($_SESSION['user']['theme']);
$profileTheme->setBanner($_SESSION['user']['banner']);
$user->setProfileTheme($profileTheme);

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
    $hasSetProfilePicture = isset($_FILES['picture']) && $_FILES['picture']['error'] != 4;

    $profilePicture = $user->getProfilePicture();
    if ($hasSetProfilePicture) {
        $profilePicture = $_FILES['picture']['name'];
    }

    $successUpdate = $user->updateProfile($description, $isPublic, $profilePicture);
    if ($successUpdate) {
        Header('Location: ./?page=account&part=profile&update=success');
    } else {
        Header('Location: ./?page=account&part=profile&update=error');
    }
    exit();
} else if (isset($_POST['update-banner'])) {
    $message = saveImage($user->getUsername(), PATH_BANNERS, 4000000);

    if ($message[0] == 1) {

        require_once(PATH_DTO . 'ProfileThemeDTO.php');
        $profileThemeDTO = new ProfileThemeDTO();

        $user->setBanner($message[2]);
        $successUpdate = $profileThemeDTO->updateOneSetBanner($user->getProfileTheme());

        if ($successUpdate) {
            Header('Location: ./?page=account&part=profile&update=success');
        } else {
            Header('Location: ./?page=account&part=profile&update=error');
        }
    } else {
        Header('Location: ./?page=account&part=profile&upload=' . $message[1]);
    }
}

// Si l'utilosateur a changé son theme de profil on fait la mise a jour
$themes = ['red', 'black', 'green', 'orange', 'violet', 'yellow'];

foreach ($themes as $theme) {
    if (isset($_POST[$theme])) {
        require_once(PATH_DTO . 'ProfileThemeDTO.php');
        require_once(PATH_CLASSES . 'ProfileTheme.php');
        $profileThemeDTO = new ProfileThemeDTO();

        $profileTheme = new ProfileTheme($theme, null);
        $profileTheme->setUserId($user->getId());

        $successUpdateTheme = $profileThemeDTO->updateOneWithoutBanner($profileTheme);
        if ($successUpdateTheme) {
            $_SESSION['user']['theme'] = $profileTheme->getTheme();
            Header('Location: ./?page=account&part=profile&theme=success');
        } else {
            Header('Location: ./?page=account&part=profile&update=error');
        }
        exit();
    }
}

$themeButtons = $profilePresenter->getAllThemesInSubmitButton();
$activeTheme = $profilePresenter->getActiveThemeInDiv();

$needsDisplay = isset($_GET['update']) || isset($_GET['delete']) || isset($_GET['upload']) || isset($_GET['theme']);
$isSuccess = IsSuccessProfile();
$returnMessage = initErrorMessageProfile();

$isPublic = $user->isPublic();

$messageChooseProfilePicture = $user->isDefaultProfilePicture() ? 'Set a profile picture' : 'Set a new profile picture';
