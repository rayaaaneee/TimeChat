<?php

if (isset($_GET['search']) && $_GET['search'] == '') {
    header('Location: ./');
    exit();
}

require_once(PATH_VIEWS_PARTS . 'header.php');

require_once(PATH_VIEWS . 'search.php');

require_once(PATH_VIEWS_PARTS . 'footer.php');
