<?php

function saveImage($file, $username): string
{
    $target_dir = PATH_PROFILE_PICTURES;
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        if ($file["size"] > 500000) {
            return "size";
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            return "format";
        }
        if (move_uploaded_file($file["tmp_name"], $target_dir . $username . "." . $imageFileType)) {
            return [1, 'success'];
        } else {
            return [0, 'error'];
        }
    }
}
