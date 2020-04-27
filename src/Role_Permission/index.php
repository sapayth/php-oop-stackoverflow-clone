<?php

namespace Src\Role_Permission;

session_start();

use Src\Authentication\FaiyazRoleBasedAuth;

include_once '../../autoload.php';


$user = new FaiyazRoleBasedAuth;
$login = $user->login('User', 'Pass1436');


// $crud = new FaiyazRolePermission();
// var_dump ($crud->getPermissionId());

echo "<br>";



 echo "<br>";

//  if($crud->checkRole() == 1){
//      echo "You are Admin";
//  }else{
//      echo "You are user";
//  }
