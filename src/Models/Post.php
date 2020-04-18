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
}

$post = new Post();
//print_r($post->allPost());