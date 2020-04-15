<?php

spl_autoload_register(function ($className) {
    $path = strtolower(str_replace("StackOverflowClone\\", "", $className).".php");
    $path = str_replace("\\", "/", $path);
    include_once($path);
});