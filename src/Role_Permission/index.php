<?php

namespace Src\Role_Permission;

session_start();

use Src\Authentication\FaiyazRoleBasedAuth;

include_once '../../autoload.php';


$user = new FaiyazRoleBasedAuth;
$login = $user->login('Admin', 'Pass1436');


$crud = new FaiyazRolePermission();

// $crud->CreatePost();
// $crud->DeletePost();