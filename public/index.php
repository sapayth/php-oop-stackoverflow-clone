<?php

require_once __DIR__ . "/../autoload.php";

use src\Database\AtikConnection;
use src\Database\ShohanConnection;
use src\Authentication\TawfiqueLoginLogout;
// include '../src/Database/ShohanConnection.php';
// include '../src/Database/AtikConnection.php';

//$databaseConnectionInstance = new ShohanConnection('localhost', 'stack_faiyaz', 'root', '');
use StackOverflowClone\Src\Database\AtikConnection;
use StackOverflowClone\Src\Database\ShohanConnection;



// include '../src/Database/ShohanConnection.php';
// include '../src/Database/AtikConnection.php';

//$databaseConnectionInstance = new ShohanConnection('localhost','rony', 'root', '');

//$databaseConnectionInstanceFromAtik = new AtikConnection('localhost', 'root', '', 'rony');
//$db = $databaseConnectionInstanceFromAtik->getConnection();

// Configure connection parameters.

// databaseConnectionInstance->setMethod
$databaseConnectionInstanceFromAtik = new AtikConnection('localhost', 'root', '', 'rony');
$db = $databaseConnectionInstanceFromAtik->getConnection();

//$check_login_logout = new TawfiqueLoginLogout();
