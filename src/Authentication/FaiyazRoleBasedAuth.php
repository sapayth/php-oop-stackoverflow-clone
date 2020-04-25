<?php

namespace Src\Authentication;

session_start(); // I am starting session here for testing purpose! this is not recommended

use PDOException;
use Src\Database\FaiyazConnection;

include_once '../../autoload.php';

class FaiyazRoleBasedAuth extends FaiyazConnection
{

    //register method
    public function register($role_id = 2, $username = "User", $password = "Pass1436")
    {
        try {

            $db = $this->connect();

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (role_id, username, password) VALUES (:role_id, :username, :password)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':role_id', $role_id);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);

            $stmt->execute();


            $last_user_id = $db->lastInsertId();

            if ($stmt->rowCount() > 0) {

                $sql = "INSERT INTO role_user (user_id, role_id) VALUES (:user_id, :role_id)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':user_id', $last_user_id);
                $stmt->bindParam(':role_id', $role_id);
                $stmt->execute();

            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //login method
    public function login($username, $password)
    {
        try {

            $sql = "SELECT * FROM `users` WHERE username = :username";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array(':username' => $username));
            $userRow = $stmt->fetch();

            if ($stmt->rowCount() > 0) {

                if (password_verify($password, $userRow['password'])) {

                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_id'] = $userRow['id'];
                    $_SESSION['username'] = $userRow['username'];

                    $this->showUerData();

                    return true;

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
        $_SESSION['user_id'] = true;
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

    public function checkRole()
    {
        $user_id = $_SESSION['user_id'];

        $db = $this->connect();
        $sql = "SELECT role_id FROM role_user WHERE user_id = $user_id";
        $stmt = $db->prepare($sql);
        $stmt->execute([$user_id]);
        
        $role_id = $stmt->fetchColumn(0);

        return $role_id;
    }

}
