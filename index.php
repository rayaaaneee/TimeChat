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
if (isset($_SESSION['user'])) {

    $user = $_SESSION['user'];
    $username = $user['username'];
    $password = $user['password'];
    $description = $user['description'];
    $profilePicturePath = $user['profile_picture'];
    $isPublic = $user['is_public'];
    $banner = $user['banner'];
    $signupAt = new DateTime($user['signup_at']);
    $id = $user['id'];

    $user = new User($username, $password, $description, $profilePicturePath, $isPublic, $banner, $signupAt, $id);
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
