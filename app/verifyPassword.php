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
