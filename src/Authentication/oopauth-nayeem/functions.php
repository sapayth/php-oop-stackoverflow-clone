<?php
require "config.php";

class LogingRegistration
{
    public function __construct()
    {
        $database = new DatabaseConnection();
    }
    public function registerUser($username, $password, $name, $email, $website)
    {
        global $pdo;

        $query = $pdo->prepare("SELECT `id` FROM `user` WHERE `username` = ? AND email = ? ");
        $query->execute(array($username, $email));
        $num = $query->rowCount();

        if ($num == 0) {
            $query = $pdo->prepare("INSERT INTO `user` (`username`,`password`,`name`,`email`,`website`) VALUES (?,?,?,?,?)");
            $query->execute(array($username, $password, $name, $email, $website));
            echo "<span style='color:green;'>Registration Completed...<a href='login.php'> Login Now</a></span>";
            return true;
        } else {
            return print "<span style='color:red'>'This Username or Email already used.. Please retry with new onw</span>";
        }

    }

    public function loginUser($email, $password)
    {
        global $pdo;
        echo $password;
        $query = $pdo->prepare("SELECT `id`,`username` FROM `user` WHERE `email` = ? AND password = ? ");
        $query->execute(array($email, $password));
        $userdata = $query->fetch();
        $num = $query->rowCount();

        if ($num == 1) {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['uid'] = $userdata['id'];
            $_SESSION['uname'] = $userdata['username'];
            $_SESSION['loin_msg'] = "Successfully Logged In";
            return true;
        } else {
            return false;
        } 

    }

    public function getAllusers()
    {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM `user` ORDER BY id DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSession()
    {
        return @$_SESSION['login'];
    }

    public function getUsername($uid)
    {
        global $pdo;
        $query = $pdo->prepare("SELECT name FROM user WHERE id = ? ");
        $query->execute(array($uid));
        $result = $query->fetch();
        echo $result['name'];
    }
    public function getUserByid($id)
    {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM user WHERE id = ? ");
        $query->execute(array($id));
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $username, $name, $email, $wesite)
    {
        global $pdo;
        $query = $pdo->prepare("UPDATE `user` SET `username` = ? , `name` = ? ,   `email` = ? , `website` = ? WHERE `id` = ?");
        $query->execute(array($username, $name, $email, $wesite, $id));
        return true;
    }

    public function getUserdetails($id)
    {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM user WHERE id = ? ");
        $query->execute(array($id));
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePassword($uid, $new_pass, $old_pass)
    {
        global $pdo;
        $query = $pdo->prepare("SELECT id FROM user WHERE password = ? ");
        $query->execute(array($old_pass));

        $num = $query->rowCount();
        if ($num == 0) {
            return print("<span style='color:#e53d37;'>Something went wrong please try again.</span>");
        } else {
            $query = $pdo->prepare("UPDATE `user` SET `password` = ? WHERE `id` = ? ");
            $query->execute(array($new_pass, $uid));
            return print("<span style='color:green'>Password Changed successfully! </span>");
        }

    }

    public function logOutUser()
    {
        $_SESSION['login'] = false;
        unset($_SESSION['uid']);
        unset($_SESSION['uname']);
        unset($_SESSION['loin_msg']);
        session_destroy();
    }

}
