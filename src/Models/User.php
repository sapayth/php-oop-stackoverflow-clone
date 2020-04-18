<?php

namespace Src\Models;

use PDOException;
use Src\Database\FaiyazQuery;

include_once '../../autoload.php';

class User extends FaiyazQuery
{
    public function getPost()
    {
       try{
          $posts = $this->getAll('posts');
           return $posts;
       }catch (PDOException $e){
           echo $e->getMessage();
       }
    }

    public function getPostById($user_id)
    {
        try{

            $sql = "SELECT * FROM posts WHERE user_id = $user_id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id]);
            return $stmt->fetchAll();

        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getUserDetails($id)
    {
        try{
            $user = $this->getById('users', $id);
            return $user;
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
}
