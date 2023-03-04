<?php

require_once(PATH_APPS . 'goSigninIfNotConnected.php');

$part = $_GET['part'] ?? 'account';

require_once(PATH_VIEWS . 'header.php');

require_once(PATH_VIEWS . 'account.php');

require_once(PATH_VIEWS . 'footer.php');
