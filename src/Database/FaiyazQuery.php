<?php

namespace StackOverflowClone\Src\Database;

use StackOverflowClone\Src\Database\FaiyazConnection;

include_once '../../autoload.php';

class FaiyazQuery extends FaiyazConnection
{
    //Using these method you can get all the users data just using username
    public function getUser($username)
    {
        $sql = "SELECT * FROM `users` WHERE username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $users = $stmt->fetchAll();

        foreach($users as $user){
            echo "Name is ". $user['username'] . "<br>";
            echo "Password is " . $user['password'] . "<br>";
        }
    }
}

// $user = new FaiyazQuery();
// $user->getUser('faiyaz');

