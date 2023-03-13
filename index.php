<?php

session_start();

require_once('config.php');
require_once(PATH_DATABASE . 'Connection.php');
require_once(PATH_CLASSES . 'WebSocket.php');

require_once(PATH_DATABASE . 'DAO.php');
require_once(PATH_DATABASE . 'DTO.php');

require_once(PATH_CLASSES . 'User.php');
require_once(PATH_DAO . 'UserDAO.php');
require_once(PATH_DTO . 'UserDTO.php');


// Si l'utilisateur est connecté, on le connecte
$user = null;
$friendRequestManager = null;
$nbNotifications = 0;
if (isset($_SESSION['user'])) {

    $user = $_SESSION['user'];
    $username = $user['username'];
    $password = $user['password'];
    $description = $user['description'];
    $profilePicturePath = $user['profile_picture'];
    $isPublic = $user['is_public'];
    $signupAt = new DateTime($user['signup_at']);
    $id = $user['id'];

    $user = new User($username, $password, $description, $profilePicturePath, $isPublic, $signupAt, $id);

    // On recupere a chaque refraichissement de page le nombre de $notifications
    require_once(PATH_DAO . 'NotificationDAO.php');
    $NotificationDAO = new NotificationDAO();

    $nbNotifications = $NotificationDAO->getCountNotificationsByUserReceiverIdNotViewed($user->getId());

    // Si l'utilisateur s'est déconnecté, on le déconnecte
    User::signedOut($user);
}

$webSocket = new WebSocket();

$page = null;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (!is_file(PATH_CONTROLLERS . $page . '.php')) {
        header('Location: ./');
    }
} else {
    $page = 'home';
}

require_once(PATH_CONTROLLERS . $page . '.php');
