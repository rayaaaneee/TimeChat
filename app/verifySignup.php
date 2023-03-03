<?php

function verifyPassword($password, $password2): string
{
    $minLength = 4;
    if ($password == $password2) {
        if (strlen($password) < $minLength) {
            return "length";
        }
        return "success";
    } else {
        return "notsames";
    }
}

function verifyPseudo($username): string
{
    $regex = "/^[a-zA-Z0-9_-]{3,20}$/";
    if (preg_match($regex, $username)) {
        return "success";
    }
    return "chars";
}

function verify($username, $password, $password2): string
{
    $messagePseudo = verifyPseudo($username);
    $messagePassword = verifyPassword($password, $password2);

    if ($messagePseudo == "success" && $messagePassword == "success") {
        return "success";
    } else {
        if ($messagePseudo != "success") {
            return $messagePseudo;
        } else {
            return $messagePassword;
        }
    }
}
