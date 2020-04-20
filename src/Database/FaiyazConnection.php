<?php
namespace Src\Database;

use PDO;

class FaiyazConnection
{
   protected $db_username = "root";
   protected $db_password = "";

   public function connect()
   {
      $pdo = new PDO('mysql:host=localhost;dbname=stack_overflow_clone', $this->db_username, $this->db_password);

      //turn on exceptions
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //set default fetch mode
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return $pdo;
   }

}