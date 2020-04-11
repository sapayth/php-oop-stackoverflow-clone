<?php

class FaiyazRegisterUser
{
    private $db_username = "root";
    private $db_password = "";
    public $connection;

    public function __construct()
    {    
        $this->connection = new PDO('mysql:host=localhost;dbname=stack_overflow_clone', $this->db_username, $this->db_password);
    }
}
