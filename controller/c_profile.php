<?php

require_once(PATH_APPS . 'goSigninIfNotConnected.php');

require_once(PATH_DAO . 'UserDAO.php');

require_once(PATH_CLASSES . 'ManageThemes.php');

require_once(PATH_PRESENTERS . 'ProfilePresenter.php');
$display = new ProfilePresenter();

$profileTheme = null;
$profileUser = null;
$privacy = "";
$isUnknown = false;
if (isset($_GET['user']) && $_GET['user'] != null) {
    if ($_GET['user'] == $_SESSION['user']['id']) {
        header('Location: ./?page=myprofile');
        exit();
    }
    $UserDAO = new UserDAO();
    $userTab = $UserDAO->getUserAndProfileThemeById($_GET['user']);

    if ($userTab['user']) {
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

        $privacy = $profileUser->isPublic() ? "public" : "private";
    } else {
        $isUnknown = true;
        $profileUser = User::getUnknownUser();

        $ManageThemes = ManageThemes::getInstance();

        $profileTheme = $ManageThemes->getThemeByColor(ProfileTheme::$defaultTheme);

        $profileUser->setProfileTheme($profileTheme);

        $privacy = "public";
    }
} else {
    header('Location: ./');
    exit();
}

$needsDisplay = false;
$isSuccess = false;
$returnMessage = "";
if (isset($_POST['action']) && $_POST['action'] == 'add-friend') {

    $needsDisplay = true;

    /* On s'occupe maintenant de l'envoi de la notification à l'utilisateur */
    require_once(PATH_CLASSES . 'Notification.php');
    require_once(PATH_DTO . 'NotificationDTO.php');

    $notification = new Notification($user->getId(), $profileUser->getId(), NotificationType::FRIEND_REQUEST);

    $NotificationDTO = new NotificationDTO();
    $isSuccess = $NotificationDTO->insertOne($notification);

    if ($isSuccess) {
        $returnMessage = "Friend request sent to @" . $profileUser->getUsername();
    } else {
        $returnMessage = "Friend request already sent to @" . $profileUser->getUsername();
    }
} else if (isset($_POST['action']) && $_POST['action'] == 'remove-friend-request') {

    $needsDisplay = true;

    require_once(PATH_CLASSES . 'Notification.php');
    require_once(PATH_DTO . 'NotificationDTO.php');
    // On s'occupe maintenant de l'envoi de la notification à l'utilisateur
    $notification = new Notification($user->getId(), $profileUser->getId(), NotificationType::FRIEND_REQUEST);

    $NotificationDTO = new NotificationDTO();
    $isSuccess = $NotificationDTO->removeOne($notification);

    if ($isSuccess) {
        $returnMessage = "Friend request to @" . $profileUser->getUsername() . " removed";
        $isSuccess = true;
    } else {
        $returnMessage = "Error while removing friend request to @" . $profileUser->getUsername();
    }
}

$isFriend = null;

$hasSendFriendRequest = false;

require_once(PATH_CONTROLLERS . 'header.php');

require_once(PATH_VIEWS . 'profile.php');

require_once(PATH_VIEWS_PARTS . 'footer.php');
