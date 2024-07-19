<?php

/** Configuration Variables **/

define('DEVELOPMENT_ENVIRONMENT', true);
ini_set('display_errors', 'On');

define('DB_NAME', 'e-commerce');
// define('DB_USER', 'hangtt');
// define('DB_PASSWORD', '1');
define('DB_USER', 'duonghue1');
define('DB_PASSWORD', 'duonghue');
define('DB_HOST', 'localhost');

define("SECRET", "tH1s_1s_S3cR3t");
// define('PATH_URL', 'http://localhost/');
define('PATH_URL', 'http://localhost/web-programming-e-commerce-main');
define('PATH_URL_IMG', PATH_URL . '/public/images/');
define('PATH_URL_IMG_HOME', PATH_URL . '/public/images/home/');
define('PATH_URL_IMG_LOGO', PATH_URL . '/public/images/logo/');
define('PATH_URL_IMG_PRODUCT', PATH_URL . '/public/images/product/');
define('PATH_URL_STYLE', PATH_URL . '/public/css/');
