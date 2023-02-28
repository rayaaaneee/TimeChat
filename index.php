<?php

require_once('config.php');
require_once(PATH_DATABASE . 'Connection.php');
require_once(PATH_MODELS . 'WebSocket.php');


session_start();

$webSocket = new WebSocket();

$page = null;
if (isset($_GET['page'])) {
    if (is_file(PATH_CONTROLLERS . 'c_' . $_GET['page'] . '.php')) {
        header('Location: ./');
    } else {
        $page = '404';
    }
} else {
    $page = 'home';
}

require_once(PATH_CONTROLLERS . $page . '.php');
