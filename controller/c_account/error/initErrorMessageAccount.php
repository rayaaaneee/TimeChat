<?php

function isSuccess()
{
    $result = false;
    if (isset($_GET['success'])) {
        $result = true;
    }
    return $result;
}

function getReturnMessage()
{
    $result = null;
    if (isset($_GET['errusername'])) {
        $result = getReturnMessageUsername();
    } else if (isset($_GET['errpassword'])) {
        $result = getReturnMessagePassword();
    } else if (isset($_GET['success'])) {
        $result = getReturnMessageSuccess();
    }
    return $result;
}

function getReturnMessageUsername()
{
    $result = null;
    if ($_GET['errusername'] === 'chars') {
        $result = 'Password must contain only letters, numbers, underscores and dashes.';
    } else if ($_GET['errusername'] === 'already') {
        $result = 'This username is already taken.';
    } else if ($_GET['errusername'] === 'sames') {
        $result = 'The new username is the same as the old one.';
    } else {
        $result = 'An error has occurred.';
    }
    return $result;
}

function getReturnMessagePassword()
{
    $result = null;
    if ($_GET['errpassword'] === 'false') {
        $result = 'Actual password is incorrect.';
    } else if ($_GET['errpassword'] === 'notsames') {
        $result = 'The new passwords are not the same.';
    } else if ($_GET['errpassword'] === 'chars') {
        $result = 'Password must contain at least 8 characters.';
    } else {
        $result = 'An error has occurred.';
    }
    return $result;
}

function getReturnMessageSuccess()
{
    $result = null;
    if ($_GET['success'] === 'username') {
        $result = 'Username has been succesfully modified.';
    } else if ($_GET['success'] === 'password') {
        $result = 'Password has been succesfully modified.';
    } else {
        $result = 'Modification has been succesfully done.';
    }
    return $result;
}
