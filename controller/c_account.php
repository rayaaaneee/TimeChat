<?php

require_once(PATH_APPS . 'goSigninIfNotConnected.php');


function getClassPage(string $tmp, $part): string
{
    if ($part === $tmp) {
        return 'active';
    }
    return '';
}

$part = $_GET['part'] ?? 'account';
$parts = ['account', 'profile', 'data', 'favorite'];
if (!in_array($part, $parts)) {
    $part = 'account';
}

require_once(PATH_CONTROLLERS . "account/c_" . $part . '.php');

require_once(PATH_VIEWS_PARTS . 'header.php');

require_once(PATH_VIEWS . 'account.php');

require_once(PATH_VIEWS_PARTS . 'footer.php');
