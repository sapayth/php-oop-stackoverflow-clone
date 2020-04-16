<?php

spl_autoload_register(function ($className) {

    $path = __DIR__.DIRECTORY_SEPARATOR.$className.".php";
    $path = str_replace("\\", DIRECTORY_SEPARATOR, $path);
    include_once($path);

});