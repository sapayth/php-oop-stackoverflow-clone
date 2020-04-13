<?php
spl_autoload_register(function ($class) {
    $classPath = __DIR__ . "/" . $class . ".php";
    $classPath = str_replace("\\", DIRECTORY_SEPARATOR, $classPath);
    if (file_exists($classPath)) {
        include_once $classPath;
    }
});
