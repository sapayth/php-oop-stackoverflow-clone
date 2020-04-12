<?php
namespace StackOverflowClone\Src\Authentication;
class FaiyazRegisterUser
{
    private $db_username = "root";
    private $db_password = "";
    public $connection;

    public function __construct()
    {    
        $this->connection = new \PDO('mysql:host=localhost;dbname=stack_overflow_clone', $this->db_username, $this->db_password);
    }

    public function register($username, $password)
    {
        try{
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->connection->prepare("INSERT INTO `users`(username,password) VALUES (:username,:password)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hashed_password);
            $stmt->execute();

            return $stmt;

        }catch(\PDOException $e){
            echo $e->getMessage();
        }
    }
}
