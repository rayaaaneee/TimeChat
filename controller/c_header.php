<?php

function getClass(bool $bool)
{
    if ($bool) {
        return 'active';
    }
    return '';
}

$displayCircleNotifications = $nbNotifications > 0;

require_once(PATH_VIEWS_PARTS . 'header.php');
