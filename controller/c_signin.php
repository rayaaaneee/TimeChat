<?php


require_once(PATH_APPS . 'goHomeIfConnected.php');

$result = null;
if (isset($_POST['signin'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $rememberMe = isset($_POST['remember']);
    $user = new User($username, $password);
    $result = $user->signin();

    if ($result[0]) {
        if ($rememberMe) {
            /* setcookie('username', $username, time() + 365 * 24 * 3600, null, null, false, true);
            setcookie('password', $password, time() + 365 * 24 * 3600, null, null, false, true); */
        }
        Header('Location: ./');
    } else {
        Header('Location: ./?page=signin&error=' . $result[1]);
    }
}

$error = null;
$success = null;
$needsDisplay = false;
$isSuccess = false;
$returnMessage = '';
if (isset($_GET['success'])) {
    $isSuccess = true;
    $returnMessage = 'You have successfully signed up';
    $needsDisplay = true;
} else {
    if (isset($_GET['error'])) {
        if ($_GET['error'] === 'username') {
            $returnMessage = 'This user doesn\'t exist';
        } else {
            $returnMessage = 'The password does not match this user';
        }
        $needsDisplay = true;
    }
}

require_once(PATH_VIEWS_PARTS . 'header.php');

require_once(PATH_VIEWS . 'signin.php');

require_once(PATH_VIEWS_PARTS . 'footer.php');
