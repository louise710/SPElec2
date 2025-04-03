<?php
function autoloader($className) {
    include 'classes/' . $className . '.php';
    // include 'University.php';
}

spl_autoload_register('autoloader');
