<?php

require_once('config.php');
require_once(PATH_DATABASE . 'Connection.php');
require_once(PATH_MODELS . 'WebSocket.php');


session_start();

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
