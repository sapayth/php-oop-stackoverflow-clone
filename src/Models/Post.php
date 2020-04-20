<?php

namespace Src\Models;

use PDOException;
use Src\Database\FaiyazQuery;

include_once '../../autoload.php';

class Post extends FaiyazQuery
{
    public function allPost()
    {
        try {

            $posts = $this->getAll('posts');
            return $posts;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postDetails($id)
    {
        try {

            $posts = $this->getById('posts', $id);
            return $posts;

        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function postUser($post_id)
    {
        try{

            $sql = "SELECT user_id FROM posts WHERE id = $post_id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$post_id]);
            return $stmt->fetch();

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
