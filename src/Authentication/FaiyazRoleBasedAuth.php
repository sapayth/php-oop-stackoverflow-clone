<?php

namespace Src\Authentication;

use PDOException;
use Src\Database\FaiyazConnection;

include_once '../../autoload.php';

class FaiyazRoleBasedAuth extends FaiyazConnection
{

    //register method
    // MUST RETURN SOMETHING AFTER SUCCESSFUL CREATION OF A NEW USER
    public function register($role_id, $username , $password)
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
                    
                    // ALWAYS SESSION START WILL BE THE FIRST THING AFTER LOGIN SUCCESS

                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_id'] = $userRow['id'];
                    $_SESSION['username'] = $userRow['username'];

                    $this->showUerData(); // THIS WAS NICE

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

// I DON'T ACTUALLY FIND ANY OF THESE TWO METHODS USAGE IN THIS CLASS    
    
/*    
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
 */

}
