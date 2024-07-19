<?php
session_start();
require "config/config.php";

define('BASEPATH', dirname(__FILE__) . '/');
define('VIEWPATH', BASEPATH . 'application/views/');
define('CONTROLPATH', BASEPATH . 'application/controllers/');
define('MODELPATH', BASEPATH . 'application/models/');



$url = !empty($_GET['url']) ? $_GET['url'] : "home/view";
$api = (isset($_REQUEST['api']) ? true : false);
require "lib/ajax.php";
require "lib/function.php";
