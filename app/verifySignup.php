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
    $forbiddenChars = [' ', '\'', '"', '!', '?', '.', ',', ';', ':', '/', '\\', '|', '(', ')', '[', ']', '{', '}', '+', '*', '=', '<', '>', '&', '$', '#', '@', '%', '°', '§', 'µ', '£', '€', '²', '¤', '¨', '¤', '©', '®', '™', '¢', '¬', '¼', '½', '¾', '×', '÷', '±', '≠', '≈', '≤', '≥', '∞', '�'];

    $usernameChars = explode('', $username);

    foreach ($usernameChars as $char) {
        if (in_array($char, $forbiddenChars)) {
            return "chars";
        }
    }
    return "success";
}

function verify($username, $password, $password2)
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
