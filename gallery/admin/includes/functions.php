<?php

function classAutoLoader($class) {

    $class = strtolower($class);

    $the_path = "includes/{$class}.php";

    if(is_file($the_path) && !class_exists($class)) {

       require_once($the_path);
    }
    else {

        die("The file named {$class}.php doesn't exist.");
    }
}

function redirect($location) {

        header("Location: {$location}");
}

function debug($msg) {
    echo "<pre>";
    echo $msg;
    echo "</pre>";
}

spl_autoload_register('classAutoLoader');