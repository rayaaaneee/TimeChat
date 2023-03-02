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

User::signedOut();

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
