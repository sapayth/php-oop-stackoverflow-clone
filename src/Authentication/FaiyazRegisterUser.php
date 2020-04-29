<?php
namespace Src\Authentication;

use Src\Database\FaiyazConnection;


// SO EXTENDING THE CLASS IS OKAY BUT IF YOU USE CONSTRCUTOR IN DATABASE CLASS THINGS CAN CHANGE A LITTLE
class FaiyazRegisterUser extends FaiyazConnection
{
    
    // MUST RETURN SOMETHING AFTER SUCCESS
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
