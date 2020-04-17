<?php
namespace Src\Authentication;

use Src\Database\FaiyazConnection;

class FaiyazRegisterUser extends FaiyazConnection
{
    public function register($username = 'asif', $password = 'Pass1436')
    {
        try {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->connect()->prepare("INSERT INTO `users`(username,password) VALUES (:username,:password)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hashed_password);
            $stmt->execute();

            return $stmt;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}

// $user = new FaiyazRegisterUser();
// $user->register();