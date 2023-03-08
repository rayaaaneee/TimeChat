<?php

function renameProfilePicture(string $profilePictureName, string $newUsername, string $ext): string
{

    $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
    $rand = rand(0, 1000);
    $newProfilePictureName = $newUsername . '-' . $date->format('m-d-y') . "-" . $rand . '.' . $ext;

    rename(PATH_PROFILE_PICTURES . $profilePictureName, PATH_PROFILE_PICTURES . $newProfilePictureName);

    return $newProfilePictureName;
}
