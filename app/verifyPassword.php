<?php

function verifyPassword($password, $password2)
{
    if ($password === $password2) {
        return true;
    } else {
        return false;
    }
}
