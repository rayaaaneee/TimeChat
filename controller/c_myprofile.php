<?php

require_once(PATH_APPS . 'goSigninIfNotConnected.php');

require_once(PATH_PRESENTERS . 'ProfilePresenter.php');
$display = new ProfilePresenter();

require_once(PATH_VIEWS . 'header.php');

require_once(PATH_VIEWS . 'myprofile.php');

require_once(PATH_VIEWS . 'footer.php');
