<?php

/* Paths */
define('PATH_VIEWS', './view/v_');
define('PATH_MODELS', './model/');
define('PATH_CONTROLLERS', './controller/c_');
define('PATH_ASSETS', './asset/');
define('PATH_APPS', './app/');

/* Models */
define('PATH_CLASSES', PATH_MODELS . 'class/');
define('PATH_DATABASE', PATH_MODELS . 'database/');
define('PATH_DAO', PATH_DATABASE . 'dao/');
define('PATH_DTO', PATH_DATABASE . 'dto/');

/* Assets */
define('PATH_CSS', PATH_ASSETS . 'css/');
define('PATH_MEDIA', PATH_ASSETS . 'media/');
define('PATH_SCRIPTS', PATH_ASSETS . 'js/');
define('PATH_IMG', PATH_ASSETS . 'img/');
define('PATH_UPLOADS', PATH_IMG . 'upload/');
define('PATH_FONTS', PATH_ASSETS . 'fonts/');
define('PATH_PRESENTERS', PATH_MODELS . 'presenter/');
define('PATH_LIBRARIES', PATH_APPS . 'library/');
define('PATH_DATAS', PATH_APPS . 'data/');

/* Uploads */
define('PATH_PROFILE_PICTURES', PATH_UPLOADS . 'profilePicture/');
define('PATH_BANNERS', PATH_UPLOADS . 'banner/');
define('PATH_GROUPS', PATH_UPLOADS . 'group/');

const DB_USER = 'root';
const DB_PASS = '';
const DB_HOST = 'localhost';
const DB_NAME = 'timechat';
const DB_PORT = '3306';
const DB_CHARSET = 'utf8mb4';
