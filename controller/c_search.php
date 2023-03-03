<?php

if (isset($_GET['search']) && $_GET['search'] == '') {
    header('Location: ./');
    exit();
}

require_once(PATH_VIEWS . 'header.php');

require_once(PATH_VIEWS . 'search.php');

require_once(PATH_VIEWS . 'footer.php');
