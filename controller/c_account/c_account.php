<?php

require_once(PATH_APPS . 'verifyInformations.php');
require_once(PATH_DTO . 'UserDTO.php');

if (isset($_POST['modify-username'])) {

    $username = $_POST['username'];
    $messageUsername = verifyPseudo($username);

    if ($messageUsername === "success") {

        $password = $_POST['password'];
        $isGoodPassword = $user->verifyPassword($password);

        if ($isGoodPassword) {

            $messageUpdate = $user->updateUsername($username);
            if ($messageUpdate === "success") {

                if (!$user->isDefaultProfilePicture()) {
                    require_once(PATH_APPS . 'renamePicture.php');

                    $userDTO = new UserDTO();

                    $profilePictureName = $user->getProfilePicture();
                    $newProfilePictureName = renamePicture($profilePictureName, PATH_PROFILE_PICTURES, $username);

                    if (!$userDTO->updateProfilePicture($newProfilePictureName, $user)) {
                        Header("Location: ./?page=account&errusername=already");
                    }
                }
                Header("Location: ./?page=account&success=username");
            } else if ($messageUpdate === "sames") {
                Header("Location: ./?page=account&errusername=sames");
            } else {
                Header("Location: ./?page=account&errusername=already");
            }
        } else {
            Header("Location: ./?page=account&errpassword=false");
        }
    } else {
        Header("Location: ./?page=account&errusername=chars");
    }

    // Si l'utilisateur a un banner, on la renomme
    if ($_SESSION['user']['banner'] != null) {
        require_once(PATH_DTO . 'ProfileThemeDTO.php');
        require_once(PATH_APPS . 'renamePicture.php');

        $bannerName = $_SESSION['user']['banner'];
        $newBannerName = renamePicture($bannerName, PATH_BANNERS, $username);

        $profileThemeDTO = new ProfileThemeDTO();
        $id = $user->getId();
        if (!$profileThemeDTO->updateOneSetBannerByBannerName($newBannerName, $id)) {
            Header("Location: ./?page=account&errusername=already");
        }
    }
} else if (isset($_POST['modify-password'])) {
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-new-password'];
    $messagePassword = verifyPassword($newPassword, $confirmPassword);

    if ($messagePassword === "success") {
        $password = $_POST['actual-password'];
        $isGoodPassword = $user->verifyPassword($password);

        if ($isGoodPassword) {
            $user->updatePassword($newPassword);
            Header("Location: ./?page=account&success=password");
        } else {
            Header("Location: ./?page=account&errpassword=false");
        }
    } else {
        if ($messagePassword === "notsames") {
            Header("Location: ./?page=account&errpassword=notsames");
        } else {
            Header("Location: ./?page=account&errpassword");
        }
    }
} else if (isset($_POST['delete-account'])) {
    /* $user->deleteAccount(); */
    echo 'delete';
}

require_once(PATH_CONTROLLERS . 'account/error/initErrorMessageAccount.php');

// Si les variables d'erreurs sont définies et non vides, on affiche le message de retour
$needsDisplay = (isset($_GET['errusername']) && $_GET['errusername'] != '') || (isset($_GET['errpassword']) && $_GET['errpassword'] != '') || (isset($_GET['success']) && $_GET['success'] != '') ? true : false;

$returnMessage = null;
if ($needsDisplay) {
    $isSuccess = isSuccess();
    $returnMessage = getReturnMessage();
}
