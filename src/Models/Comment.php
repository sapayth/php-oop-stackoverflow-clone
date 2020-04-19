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
}

