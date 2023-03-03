<?php

require_once(PATH_APPS . 'goHomeIfConnected.php');
require_once(PATH_APPS . 'verifySignup.php');

$user = null;
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $description = $_POST['description'];

    // On vérifie si l'utilisateur a upload une image de profil, si oui on la stocke dans la variable $file, sinon on met l'image par défaut
    $file = "default.png";
    if ($_FILES['file']['name'] != "") {
        $file = $_FILES['file']['name'];
    }


    $public = false;
    if (isset($_POST['public'])) $public = true;

    /* On vérifie qu'il n'y a pas d'erreur dans le mot de passe et dans la base de données,
    si il n'y a pas d'erreur, on crée un nouvel utilisateur et on l'insère dans la base de données , sinon on affiche un message d'erreur */
    $errorPassword = null;
    $errorPasswordUsername = verifyPassword($password, $password2, $username);
    if ($errorPasswordUsername == 'success') {
        $user = new User($username, $password, $description, $file, $public);
        $messageDatabaseOrUpload = $user->signup();
        if ($messageDatabaseOrUpload == 'success') {
            Header('Location: ./?page=signin&success');
        } else {
            Header('Location: ./?page=signup&error=' . $messageDatabaseOrUpload);
        }
        exit();
    } else {
        Header('Location: ./?page=signup&error=' . $errorPasswordUsername);
        exit();
    }
}

// On récupère l'erreur s'il y en a une et la stocke dans la variable error
$error = $_GET['error'] ?? null;
$errorUpload = $_GET['upload'] ?? null;
$errorMessage = null;
if ($errorUpload) {
    switch ($errorUpload) {
        case 'size':
            $errorMessage = 'File too large';
            break;
        case 'type':
            $errorMessage = 'File type not supported';
            break;
        case 'unknown':
            $errorMessage = 'An error has occurred';
            break;
    }
} else if ($error) {
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
        case 'chars':
            $errorMessage = 'Please enter a valid username';
            break;
        case 'unknown':
            $errorMessage = 'An error has occurred';
            break;
    }
}

$hasError = $error || $errorUpload;

require_once(PATH_VIEWS . 'header.php');

require_once(PATH_VIEWS . 'signup.php');

require_once(PATH_VIEWS . 'footer.php');
