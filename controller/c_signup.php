<?php

require_once(PATH_APPS . 'goHomeIfConnected.php');
require_once(PATH_APPS . 'verifyPassword.php');

$user = null;
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $description = $_POST['description'];
    $file = $_POST['file'];

    $public = false;
    if (isset($_POST['public'])) $public = true;

    if (verifyPassword($password, $password2)) {
        $user = new User($username, $password, $description, $public, $file);
        $user->signup();
    } else {
        Header('Location: ./?page=signup&error=password');
    }
}
require_once(PATH_VIEWS . 'header.php');

require_once(PATH_VIEWS . 'signup.php');

require_once(PATH_VIEWS . 'footer.php');
