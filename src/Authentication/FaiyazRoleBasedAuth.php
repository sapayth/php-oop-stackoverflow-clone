<?php

namespace Src\Authentication;

session_start(); // I am starting session here for testing purpose! this is not recommended

use PDOException;
use Src\Database\FaiyazConnection;

include_once '../../autoload.php';

class FaiyazRoleBasedAuth extends FaiyazConnection
{
    //register method
    public function register($role_id = 2, $username = "Bristy", $password = "Pass1436")
    {
        try {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO `users` (role_id, username, password) VALUES (:role_id, :username, :password)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':role_id', $role_id);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //login method
    public function login($username = 'Faiyaz', $password = 'pass1436')
    {
        try {

            $sql = "SELECT * FROM `users` WHERE username = :username";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array(':username' => $username));
            $userRow = $stmt->fetch();

            if ($stmt->rowCount() > 0) {

                if (password_verify($password, $userRow['password'])) {

                    if(!$this->checkIfAuthenticated()){

                        return false;

                    } else{

                        $_SESSION['loggedin'] = true;
                        $_SESSION['user_id'] = $userRow['id'];
                        $_SESSION['username'] = $userRow['username'];
                        
                        $this->showUerData();

                        return true;
                    }  

                } else {
                    return false;
                }
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function showUerData()
    {
        echo "You are logged in, " . $_SESSION['username'];
        echo "<br>";
    }

    public function setAuthenticate()
    {
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id']  = true;
        $_SESSION['username'] = true;
        return true;
    }
    
    public function checkIfAuthenticated()
    {
        if ($this->setAuthenticate()) {
            return true;
        }
        return false;
    }
    
}

$user = new FaiyazRoleBasedAuth();
$user->login();

