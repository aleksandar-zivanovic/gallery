<?php

function classAutoLoader($class) {
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";
    

    if(file_exists($the_path)) {
        require_once '$the_path';
    } else {
        die("ERROR: file {$the_path} doesn't exists");
    }
    
//    if(is_file($the_path) && !class_exists($class)){
//        include_once '$the_path';
//    }
    
}

spl_autoload_register('classAutoLoader');
?>