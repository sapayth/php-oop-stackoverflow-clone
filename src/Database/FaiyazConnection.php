<?php
namespace Src\Database;

use PDO;

class FaiyazConnection
{
   
   // THIS TWO PROPERTIES ARE INITIALIZED HERE

   protected $db_username = "root";
   protected $db_password = "";
   
   // YOU CAN TRY CREATING A CONSTRUCTOR FUNCTION HERE AND PASS THE PROPERTY WHEN CREATING A NEW INSTANCE OF THIS CLASS
   // public function __construct()


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
