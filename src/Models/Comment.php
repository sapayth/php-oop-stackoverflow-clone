<?php

namespace Src\Models;

use PDOException;
use Src\Database\FaiyazQuery;

include_once '../../autoload.php';

class Comment extends FaiyazQuery
{
    public function allComments()
    {
        try {

            $comments = $this->getAll('comments');
            return $comments;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function commentDetails($id)
    {
        try {

            $comments = $this->getById('comments', $id);
            return $comments;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function commentPost($id)
    {
        try {

            $sql = "SELECT post_id FROM comments WHERE id = $id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->fetch();

        } catch (PDOException $e) {
           echo $e->getMessage();
        }
    }

}

