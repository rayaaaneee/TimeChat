<?php

require_once(PATH_APPS . 'saveImage.php');

function echoChecked($bool)
{
    if ($bool) {
        echo 'checked';
    }
}

function echoPublic($bool)
{
    if ($bool) {
        echo 'public';
    } else {
        echo 'private';
    }
}

/* Il y a deux case a traiter, si il a update son profil, ou si il a supprimé sa photo
de profil */
if (isset($_POST['remove-profile-picture'])) {
    $succesRemove = $user->removeProfilePicture();
    if ($succesRemove) {
        Header('Location: ./?page=account&part=profile&delete=success');
    } else {
        Header('Location: ./?page=account&part=profile&delete=error');
    }
    exit();
} else if (isset($_POST['update-profile'])) {
    $description = $_POST['description'];
    $isPublic = isset($_POST['is-public']);
    $hasSetProfilePicture = isset($_FILES['profile-picture']);
    var_dump($hasSetProfilePicture);

    $profilePicture = "default.png";
    if ($hasSetProfilePicture) {
        $profilePicture = $_FILES['profile-picture']['name'];
    }

    $successUpdate = $user->updateProfile($description, $isPublic, $profilePicture);
    if ($successUpdate) {
        Header('Location: ./?page=account&part=profile&update=success');
    } else {
        Header('Location: ./?page=account&part=profile&update=error');
    }
    exit();
}

$isPublic = $user->isPublic();
