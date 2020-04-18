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
}
