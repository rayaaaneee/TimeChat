<?php
$needsDisplay = false;
$isSuccess = false;
$returnMessage = null;
if (isset($_POST['accept-request'])) {
    $needsDisplay = true;

    foreach ($notificationsFriends as $notification) {
        if ($notification->getIdUserSender() == $_POST['id_friend']) {

            require_once(PATH_CLASSES . 'FriendRelation.php');
            require_once(PATH_DTO . 'FriendRelationDTO.php');
            require_once(PATH_DTO . 'NotificationDTO.php');

            NotificationDTO::removeOne($notification);

            if ($isSuccess) {
                $ids = [$user->getId(), $notification->getIdUserSender()];
                $friendRelation = new FriendRelation($ids);
                $isSuccess = FriendRelationDTO::insertOne($friendRelation);

                if ($isSuccess) {
                    $isSuccess = true;
                    $returnMessage = 'Friend request accepted, you are now friends with this user.';
                } else {
                    $returnMessage = 'An error occured, please try again later.';
                    break;
                }
            } else {
                $returnMessage = 'An error occured, please try again later.';
                break;
            }

            $friendRelation = new FriendRelation([$user->getId(), $notification->getIdUserSender()]);

            array_splice($notificationsFriends, array_search($notification, $notificationsFriends), 1);
            $nbNotificationsFriends--;

            break;
        }
    }
} elseif (isset($_POST['decline-request'])) {
    $needsDisplay = true;

    $isSuccess = true;

    $returnMessage = 'Friend request declined.';
}

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

require_once(PATH_VIEWS . 'notification/v_friend.php');
