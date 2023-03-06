<?php

function IsSuccessProfile()
{
    $result = false;
    if (isset($_GET['update'])) {
        $result = $_GET['update'] === 'success';
    } else if (isset($_GET['delete'])) {
        $result = $_GET['delete'] === 'success';
    } else if (isset($_GET['upload'])) {
        $result = $_GET['upload'] === 'success';
    }
    return $result;
}

function initErrorMessageProfile()
{
    $message = '';
    if (isset($_GET['update'])) {
        if ($_GET['update'] === 'success') {
            $message = 'Your profile has been updated';
        } else {
            $message = 'An error occured while updating your profile';
        }
    } else if (isset($_GET['delete'])) {
        if ($_GET['delete'] === 'success') {
            $message = 'Your profile picture has been deleted';
        } else {
            $message = 'An error occured while deleting your profile picture';
        }
    } else if (isset($_GET['upload'])) {
        $messageUpload = $_GET['upload'];
        if ($messageUpload === 'success') {
            $message = 'Your profile picture has been updated';
        } else if ($messageUpload === 'size') {
            $message = 'Your profile picture is too big, it must be less than 2MB';
        } else if ($messageUpload === 'type') {
            $message = 'Your profile picture must be a jpg, jpeg, png, gif, webp, ico or svg';
        } else if ($messageUpload === 'ferror') {
            $message = 'An error occured while uploading your profile picture';
        } else if ($messageUpload === 'move') {
            $message = 'An error occured while moving your profile picture';
        }
    } else {
        $message = '';
    }
    return $message;
}
