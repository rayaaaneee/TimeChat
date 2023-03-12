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
    require_once(PATH_CLASSES . 'FriendRequest.php');
    require_once(PATH_DTO . 'FriendRequestDTO.php');

    $FriendRequest = new FriendRequest($profileUser->getId());

    $FriendRequestDTO = new FriendRequestDTO();
    $bool = $FriendRequestDTO->insertFriendRequest($FriendRequest);
    $needsDisplay = true;
    if ($bool) {
        $isSuccess = true;
        $returnMessage = "Friend request sent to @" . $profileUser->getUsername();

        /* On s'occupe maintenant de l'envoi de la notification à l'utilisateur */
        require_once(PATH_CLASSES . 'Notification.php');
        require_once(PATH_DTO . 'NotificationDTO.php');

        $notification = new Notification($user->getId(), $profileUser->getId(), NotificationType::FRIEND_REQUEST);

        $NotificationDTO = new NotificationDTO();
        $successSendNotification = $NotificationDTO->insertOne($notification);
        if ($successSendNotification) {
            $returnMessage .= " and notification sent";
        } else {
            $returnMessage .= " but notification not sent";
        }
    } else {
        $returnMessage = "Friend request already sent to @" . $profileUser->getUsername();
    }
} else if (isset($_POST['action']) && $_POST['action'] == 'remove-friend-request') {
    require_once(PATH_CLASSES . 'FriendRequest.php');
    require_once(PATH_DTO . 'FriendRequestDTO.php');
    $friendRequest = new FriendRequest($profileUser->getId(), $user->getId());
    $FriendRequestDTO = new FriendRequestDTO();

    $message = $FriendRequestDTO->removeFriendRequest($friendRequest);
    $needsDisplay = true;
    if ($message == "success") {

        require_once(PATH_CLASSES . 'Notification.php');
        require_once(PATH_DTO . 'NotificationDTO.php');
        // On s'occupe maintenant de l'envoi de la notification à l'utilisateur
        $notification = new Notification($user->getId(), $profileUser->getId(), NotificationType::FRIEND_REQUEST);

        $isSuccess = true;
        $returnMessage = "Friend request to @" . $profileUser->getUsername() . " removed";
        $NotificationDTO = new NotificationDTO();
        $successSendNotification = $NotificationDTO->removeOne($notification);
        if ($successSendNotification) {
            $returnMessage .= " and notification unsent";
        } else {
            $returnMessage .= " but notification not unsent";
        }
    } else if ($message == "not-found") {
        $returnMessage = "You haven't send a friend request to @" . $profileUser->getUsername() . "";
    } else {
        $returnMessage = "Unknown error";
    }
}

require_once(PATH_DAO . 'FriendRequestDAO.php');
require_once(PATH_CLASSES . 'FriendRequestManager.php');

$friendRequestDAO = new FriendRequestDAO();
$friendRequests = $friendRequestDAO->getAllFriendRequestsBySender($user->getId());

$friendRequestManager = new FriendRequestManager($friendRequests);
$hasSendFriendRequest = $friendRequestManager->hasSendFriendRequest($profileUser->getId());
if ($hasSendFriendRequest) {
    $friendRequest = $friendRequestManager->getFriendRequest();
}

$isFriend = null;

require_once(PATH_CONTROLLERS . 'header.php');

require_once(PATH_VIEWS . 'profile.php');

require_once(PATH_VIEWS_PARTS . 'footer.php');
