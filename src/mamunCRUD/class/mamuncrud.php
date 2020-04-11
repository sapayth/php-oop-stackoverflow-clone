<?php 

class MamunCRUD
{
	private $server = 'localhost';
	private $username = 'root';
	private $password = '';
	private $db = 'php-oop-stackoverflow-clone';
	private $conn;

    public function __construct()
    {
        try {
        	$this->conn = new PDO('mysql:host=localhost;dbname=php-oop-stackoverflow-clone', $this->username, $this->password);
        	// $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        } catch (Exception $e) {
        	echo 'Connection failed' . $e->getMessage();
        }
    }
}

?>