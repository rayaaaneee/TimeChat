<?php

require_once(PATH_APPS . 'goHomeIfConnected.php');
require_once(PATH_APPS . 'verifyInformations.php');

$user = null;
if (isset($_POST['signup'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $description = htmlspecialchars($_POST['description']);

    // On vérifie si l'utilisateur a upload une image de profil, si oui on la stocke dans la variable $file, sinon on met l'image par défaut
    $file = "default.png";
    if (isset($_FILES['picture']) && $_FILES['picture']['name'] != "") {
        $file = $_FILES['picture']['name'];
    }


    $public = false;
    if (isset($_POST['public'])) $public = true;

    /* On vérifie qu'il n'y a pas d'erreur dans le mot de passe et dans la base de données,
    si il n'y a pas d'erreur, on crée un nouvel utilisateur et on l'insère dans la base de données , sinon on affiche un message d'erreur */
    $errorPassword = null;
    $errorPasswordUsername = verify($username, $password, $password2);
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
$returnMessage = '';
$needsDisplay = false;
$isSuccess = false;
if ($errorUpload) {
    $needsDisplay = true;
    switch ($errorUpload) {
        case 'size':
            $returnMessage = 'File too large';
            break;
        case 'type':
            $returnMessage = 'File type not supported';
            break;
        case 'unknown':
            $returnMessage = 'An error has occurred';
            break;
    }
} else if ($error) {
    $needsDisplay = true;
    switch ($error) {
        case 'username':
            $returnMessage = 'Username already taken';
            break;
        case 'length':
            $returnMessage = 'Password must be at least 8 characters long';
            break;
        case 'notsames':
            $returnMessage = 'Passwords do not match';
            break;
        case 'chars':
            $returnMessage = 'Please enter a valid username ( only letters, numbers, underscores and dashes are allowed )';
            break;
        case 'unknown':
            $returnMessage = 'An error has occurred';
            break;
    }
}

$hasError = $error || $errorUpload;

require_once(PATH_VIEWS . 'header.php');

require_once(PATH_VIEWS . 'signup.php');

require_once(PATH_VIEWS . 'footer.php');
