<?php


if (isset($_POST['generate'])) {
    require_once(PATH_CLASSES . 'GenerateJSON.php');
    $generateJSON = GenerateJSON::getInstance();
    $generateJSON->generate($_SESSION);
    exit;
}
