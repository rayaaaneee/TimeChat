<?php

require_once(PATH_APPS . 'goHomeIfConnected.php');
require_once(PATH_APPS . 'verifyPassword.php');

$user = null;
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $description = $_POST['description'];

    $file = "default.png";
    if ($_POST['file'] != "") $file = $_POST['file'];
    $_FILES['file'] = $_POST['file'];

    $public = false;
    if (isset($_POST['public'])) $public = true;

    /* On vérifie qu'il n'y a pas d'erreur dans le mot de passe et dans la base de données,
    si il n'y a pas d'erreur, on crée un nouvel utilisateur et on l'insère dans la base de données , sinon on affiche un message d'erreur */

    $errorPassword = null;
    $errorPassword = verifyPassword($password, $password2);
    if ($errorPassword == 'success') {
        $user = new User($username, $password, $description, $file, $public);
        $messageDatabase = $user->signup();
        if ($messageDatabase == 'success') {
            Header('Location: ./?page=signin&success');
            echo 'success';
        } else {
            Header('Location: ./?page=signup&error=' . $messageDatabase);
            echo 'erreurDatabase';
        }
    } else {
        echo 'erreurMotDePasse';
        Header('Location: ./?page=signup&error=' . $errorPassword);
    }
}

// On récupère l'erreur s'il y en a une et la stocke dans la variable error
$error = $_GET['error'] ?? null;
$errorMessage = null;
if ($error) {
    switch ($error) {
        case 'username':
            $errorMessage = 'Username already taken';
            break;
        case 'length':
            $errorMessage = 'Password must be at least 8 characters long';
            break;
        case 'notsames':
            $errorMessage = 'Passwords do not match';
            break;
        case 'unknown':
            $errorMessage = 'An error has occurred';
            break;
    }
}

require_once(PATH_VIEWS . 'header.php');

require_once(PATH_VIEWS . 'signup.php');

require_once(PATH_VIEWS . 'footer.php');
