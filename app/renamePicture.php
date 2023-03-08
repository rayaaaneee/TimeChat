<?php

function renamePicture(string $oldFileName, string $PATH, string $newUsername): string
{

    $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
    $rand = rand(0, 1000);
    $ext = explode('.', $oldFileName);
    $ext = array_reverse($ext)[0];

    $newPictureName = $newUsername . '-' . $date->format('m-d-y') . "-" . $rand . '.' . $ext;

    rename($PATH . $oldFileName, $PATH . $newPictureName);

    return $newPictureName;
}
