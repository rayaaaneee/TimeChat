<?php

$senderIds = array();

if ($nbNotificationsFriends > 0) {
    foreach ($notificationsFriends as $notification) {
        $senderIds[] = $notification->getIdUserSender();
    }

    $users = UserDAO::getUsersByIds($senderIds);

    // On associe les utilisateurs aux notifications
    for ($i = 0; $i < count($notificationsFriends); $i++) {
        $notificationsFriends[$i]->setUserSender($users[$i]);
    }
}

$needsDisplay = false;
$isSuccess = false;
$returnMessage = null;
if (isset($_POST['accept-request'])) {
    $needsDisplay = true;

    $isSuccess = true;

    $returnMessage = 'Friend request accepted, you are now friends with this user.';
} elseif (isset($_POST['decline-request'])) {
    $needsDisplay = true;

    $isSuccess = true;

    $returnMessage = 'Friend request declined.';
}


require_once(PATH_VIEWS . 'notification/v_friend.php');
