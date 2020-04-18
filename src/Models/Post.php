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
}

// $post = new Post();
// print_r($post->postDetails(1));