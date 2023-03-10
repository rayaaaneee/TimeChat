<?php

require_once(PATH_APPS . 'goSigninIfNotConnected.php');

require_once(PATH_DAO . 'UserDAO.php');

require_once(PATH_CLASSES . 'ManageThemes.php');

require_once(PATH_PRESENTERS . 'ProfilePresenter.php');
$display = new ProfilePresenter();

$profileTheme = null;
$profileUser = null;
$privacy = "";

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

        $privacy = $profileUser->isPublic() ? "public" : "private";
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
        $returnMessage = "Friend request sent";
    } else {
        $returnMessage = "Friend request already sent";
    }
} else if (isset($_POST['action']) && $_POST['action'] == 'remove-friend-request') {
    require_once(PATH_CLASSES . 'FriendRequest.php');
    require_once(PATH_DTO . 'FriendRequestDTO.php');
    $friendRequest = new FriendRequest($profileUser->getId(), $user->getId());
    $FriendRequestDTO = new FriendRequestDTO();

    $message = $FriendRequestDTO->removeFriendRequest($friendRequest);
    $needsDisplay = true;
    if ($message == "success") {
        $isSuccess = true;
        $returnMessage = "Friend request to @" . $profileUser->getUsername() . " removed";
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
$isFriend = null;

require_once(PATH_VIEWS_PARTS . 'header.php');

require_once(PATH_VIEWS . 'profile.php');

require_once(PATH_VIEWS_PARTS . 'footer.php');
