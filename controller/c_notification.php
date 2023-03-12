<?php

require_once(PATH_APPS . 'goSigninIfNotConnected.php');


function echoActive($menupart, $part)
{
    if ($menupart == $part) {
        return 'active';
    }
}

$titlePage = '';
$title = '';

if ($nbNotifications > 0) {
    $titlePage = 'Notifications (' . $nbNotifications . ')';
    $title = 'Notifications';
} else {
    $titlePage = 'Aucune notification';
    $title = 'Aucune notification';
}

require_once(PATH_DAO . 'NotificationDAO.php');
require_once(PATH_CLASSES . 'ManageNotifications.php');


$notifications = NotificationDAO::getNotificationsByUserReceiverId($user->getId());
$manageNotifications = new ManageNotifications($notifications);

$notificationsMessages = $manageNotifications->getNotificationsByTypes(NotificationType::MESSAGES);
$nbNotificationsMessages = count($notificationsMessages);

$notificationsFriends = $manageNotifications->getNotificationsByTypes(NotificationType::FRIENDS);
$nbNotificationsFriends = count($notificationsFriends);

$notificationsGroups = $manageNotifications->getNotificationsByTypes(NotificationType::GROUPS);
$nbNotificationsGroups = count($notificationsGroups);

$part = 'message';
if (isset($_GET['part'])) {
    if (is_file(PATH_CONTROLLERS . 'notification/c_' . $_GET['part'] . '.php')) {
        $part = $_GET['part'];
    }
}

$indexNotification = 0;

require_once(PATH_CONTROLLERS . 'header.php');

require_once(PATH_VIEWS . 'notification.php');

require_once(PATH_VIEWS_PARTS . 'footer.php');
