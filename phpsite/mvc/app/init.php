<?php

spl_autoload_register(function($class){
     $baseClasses = 'classes';
     $vendorClasses = '/vendor/firebase/php-jwt/src/';
     $dirHandler = opendir($baseClasses);
     var_dump(readdir($dirHandler)); 
     if(is_file(__DIR__.$baseClasses.$class.'php') && !class_exists($class)) 
        require_once __DIR__.$baseClasses.$class.'.php';
     elseif(is_file(__DIR__.$vendorClasses.$class.'php'))
        require_once __DIR__.$vendorClasses.$class.'.php'; 
});

function parseDir(){
      return true;
}