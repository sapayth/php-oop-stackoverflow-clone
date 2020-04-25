<?php



namespace Src\Role_Permission;


use Src\Authentication\FaiyazRoleBasedAuth;

include_once '../../autoload.php';

$perm = new FaiyazRolePermission();
$perm->createPermission();

$user = new FaiyazRoleBasedAuth;
$login = $user->login('User', 'Pass1436');

$crud = new FaiyazRolePermission();
$crud->DeletePost();
 echo "<br>";

 if($user->checkRole() == 1){
     echo "You are Admin";
 }else{
     echo "You are user";
 }
