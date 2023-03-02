<?php


require_once(PATH_APPS . 'goHomeIfConnected.php');

$result = null;
if (isset($_POST['signin'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $rememberMe = isset($_POST['remember']);
    $user = new User($username, $password);
    $result = $user->signin();

    if ($result) {
        if ($rememberMe) {
            /* setcookie('username', $username, time() + 365 * 24 * 3600, null, null, false, true);
            setcookie('password', $password, time() + 365 * 24 * 3600, null, null, false, true); */
        }
        $_SESSION['user'] = $result;
        Header('Location: ./');
    } else {
        Header('Location: ./?page=signin&error');
    }
}

$error = null;
$success = null;
if (isset($_GET['success'])) {
    $success = 'You have successfully signed up';
} else {
    if (isset($_GET['error'])) {
        $error = 'Wrong username or password';
    }
}

require_once(PATH_VIEWS . 'header.php');

require_once(PATH_VIEWS . 'signin.php');

require_once(PATH_VIEWS . 'footer.php');
