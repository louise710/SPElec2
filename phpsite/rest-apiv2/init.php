<?php

// Include ORM dependencies
require_once __DIR__ . '/../ORM/iDBFuncs.php';
require_once __DIR__ . '/../ORM/DBORM.php';

spl_autoload_register(function ($class) {
      require_once __DIR__.'/classes/'.$class.'.php';
});