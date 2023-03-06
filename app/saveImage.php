<?php

function saveImage($username, $path)
{
    $file = $_FILES['profile-picture'];

    unset($_FILES['profile-picture']);

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $rand = rand(0, 1000);

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'ico', 'svg');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 2000000) {
                $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
                $fileNameNew = $username . '-' . $date->format('m-d-y') . "-" . $rand . "." . $fileActualExt;
                $fileDestination = $path . $fileNameNew;
                try {
                    move_uploaded_file($fileTmpName, $fileDestination);
                } catch (Exception $e) {
                    return [0, "move"];
                }
                return [1, "success", $fileNameNew];
            } else {
                return [0, "size"];
            }
        } else {
            return [0, "ferror"];
        }
    } else {
        return [0, "type"];
    }
}
