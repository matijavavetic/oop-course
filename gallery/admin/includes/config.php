<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', DS . 'xampp' . DS . 'htdocs' . DS . 'oop_course' . DS . 'gallery');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');

// Database connection constants

define('DB_HOST','localhost');
define('DB_USER','root'); // default za phpmyadmin
define('DB_PASS','');
define('DB_NAME','gallery_db');


