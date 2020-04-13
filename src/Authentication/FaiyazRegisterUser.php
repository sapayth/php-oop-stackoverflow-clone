<?php
namespace StackOverflowClone\Src\Authentication;

use PDOException;
use StackOverflowClone\Src\Database\FaiyazConnection;

include_once '../../autoload.php';

class FaiyazRegisterUser extends FaiyazConnection
{
    public function register($username, $password)
    {
        try{
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->connection->prepare("INSERT INTO `users`(username,password) VALUES (:username,:password)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hashed_password);
            $stmt->execute();

            return $stmt;

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

