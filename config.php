<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
	session_start();

  define('ROOT_PATH', dirname(__FILE__));
/*
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'portfolio');
  define('DB_HOST', 'localhost');*/


define('DB_USER', 'xxxxxxxxxxxxx');
  define('DB_PASS', 'xxxxxxxxx');
  define('DB_NAME', 'xxxxxxxxxxxxx');
  define('DB_HOST', 'xxxxxxxxxxxxx');
  define('USER', 'xxx');
  define('PASS', 'xxx');

  define('UPLOAD_DIR', ROOT_PATH.'/public_html/img/thumbnail/');
  //define('LOG_DIR', ROOT_PATH.'/public_html/admin/');
  
require_once(ROOT_PATH.'/includes.php');  
  date_default_timezone_set('Europe/Stockholm');
  
  
 ?>