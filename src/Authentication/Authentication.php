<?php
    namespace Src\Authentication;

use PDO;
use PDOException;
use Src\Database\AtikConnection;

class Authentication extends AtikConnection
{
    
/*==========================================
    SECTION DONE BY FAIYAZ START
============================================*/


    public function register($username = 'asif', $password = 'Pass1436')
    {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->connect()->prepare("INSERT INTO `users`(username,password) VALUES (:username,:password)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hashed_password);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /*==========================================
        SECTION DONE BY FAIYAZ ENDS
    ============================================*/


    /*==========================================
        SECTION DONE BY TAWFIQUE STARTS
    ============================================*/

    public function userLogin($username, $password)
    {
        try {
            // check username exist or not
            $sql = "SELECT username FROM users WHERE username='$username'";
            $result = $this->connection->prepare($sql);
            $result->execute();
            $checkRow = $result->rowCount();

            if ($checkRow > 0) {
                // login process starts
                $sql = "SELECT username, password FROM users WHERE username='$username'";
                $result = $this->connection->prepare($sql);
                $result->execute();

                $row = $result->fetch(PDO::FETCH_ASSOC); //fetch array
                $stored_password = $row['password'];
                $check = password_verify($password, $stored_password);

                if ($check) {
                    echo "Logged In";
                } else {
                    echo "Wrong Password";
                }
            } else {
                echo "No username found in database";
                exit();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function userLogout()
    {
        session_start();
        session_destroy();

        header("location:login.php");
    }

    /*==========================================
        SECTION DONE BY TAWFIQUE STARTS
    ============================================*/


    /*==========================================
        SECTION DONE BY SUKKUR STARTS
    ============================================*/


    public function justAfterLoginConstructor()
    {
        session_start();
        $_SESSION['loggedin'] = false;
        $_SESSION['username'] = false;
    }

    public function setAuthenticate($usename)
    {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $usename;
        return true;
    }

    public function logout()
    {
        unset($_SESSION['loggedin']);
        unset($_SESSION['username']);
        session_destroy();
    }

    public function getAuthenticatedUser()
    {
        return $_SESSION['username'];
    }

    public function checkIfAuthenticated($usename)
    {
        if ($this->setAuthenticate($usename)) {
            return true;
        }
        return false;
    }

    /*==========================================
        SECTION DONE BY SUKKUR STARTS
    ============================================*/


    /*==========================================
        SECTION DONE BY ARUP STARTS
    ============================================*/


    public function emailCheck($email){
        $sql = "SELECT email FROM users WHERE email = :email";
        $query  = $this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->execute();
        if($query->rowCount() >0){
            return true;
        }else{
            return false;
        }
    }


    public function userForgotPassword($data){
        $email       = $data['email'];
        $check_email = $this->emailCheck($email);

        if( $email == "" ){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field Must not be Empty</div>";
            return $msg;
        }


        if($check_email == false){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>  Email Not Match!</div>";
            return $msg;
        }

        $result = $this->getForgotPassword($email);
        if($result){
            // Session::init();
            // Session::set("login",false);
            // Session::set("id",$result->id);
            // Session::set("name",$result->name);
            // Session::set("username",$result->username);
            // header("Location:create-reset-password.php");
        }else{
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Data Not Found!</div>";
            return $msg; 
        }

       }

       public function getForgotPassword($email){
        $sql = "SELECT * FROM users WHERE email = :email  LIMIT 1";
        $query  = $this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
       }
        


       public function ChangePasswordWithoutLogin($id,$data){
        $password        = $data['password'];

        if($password == ""  ){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field Must not be Empty</div>";
            return $msg;
        } 
        if(strlen($password) <6){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Password Too short. Must Length 6 Up  !</div>";
            return $msg;
         }

         $password        = md5($data['password']);

        $sql = "UPDATE users SET
                password = :password
                WHERE id = :id";

                $query  = $this->db->pdo->prepare($sql);

                $query->bindValue(':password',$password);
                $query->bindValue(':id',$id);
                $result =  $query->execute();
        if($result){

            //Session::set("password_change","<div class='alert alert-success'><strong>Success!</strong> Password Change!</div>");
            header("Location:login.php");
        }else{
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Not Updated !</div>";
            return $msg;
        } 
    }

       /*==========================================
        SECTION DONE BY ARUP STARTS
    ============================================*/


}
