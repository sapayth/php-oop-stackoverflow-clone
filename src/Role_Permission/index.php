<?php



namespace Src\Role_Permission;


use Src\Authentication\FaiyazRoleBasedAuth;

include_once '../../autoload.php';


$user = new FaiyazRoleBasedAuth;
$login = $user->login('Admin', 'Pass1436');

$crud = new FaiyazRolePermission();
$crud->DeletePost();




 echo "<br>";

 if($user->checkRole() == 1){
     echo "You are Admin";
 }else{
     echo "You are user";
 }
