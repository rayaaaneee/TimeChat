<?php

$result = null;
if (isset($_POST['signin'])) {
    $user = new User($_POST['username'], $_POST['password']);
    $result = $user->signin();

    if ($result) {
        $_SESSION['user'] = $result;
        Header('Location: ./');
    } else {
        $error = 'Wrong email or password';
    }
}

require_once(PATH_VIEWS . 'header.php');

require_once(PATH_VIEWS . 'signin.php');

require_once(PATH_VIEWS . 'footer.php');
