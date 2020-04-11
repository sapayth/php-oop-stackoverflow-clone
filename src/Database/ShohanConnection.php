<?php

include '../src/Database/ConnectionInterface.php';


class ShohanConnection implements ConnectionInterface
{
    protected $link;

    private $database, $username, $password;
    
    public function __construct($host, $database, $username, $password)
    {
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;

        $this->connect();
    }
    
    private function connect()
    {
        $this->link = new PDO('mysql:host=localhost;dbname=stack_faiyaz', $this->username, $this->password);
    }
    
    public function __sleep()
    {
        return array('database', 'username', 'password');
    }
    
    public function __wakeup()
    {
        $this->connect();
    }
}?>
