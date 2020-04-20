<?php

namespace Src\Authentication;

use PDOException;
use Src\Database\FaiyazConnection;

include_once '../../autoload.php';

class FaiyazRoleBasedAuth extends FaiyazConnection
{
    //register method
    public function register($role_id = 1, $username = 'faiyaz854', $password = 'pass1436')
    {
        try{

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO `users` (role_id, username, password) VALUES (:role_id, :username, :password)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':role_id', $role_id);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();

            return $stmt;

        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

$obj = new FaiyazRoleBasedAuth();
$obj->register();