<?php

namespace src\Authentication;

use PDO;

class TawfiqueLoginLogout
{

	private $db_username = "root";
	private $db_password = "";
	public $connection;

	public function __construct()
	{
		$this->connection = new PDO('mysql:host=localhost;dbname=stack_overflow_clone', $this->db_username, $this->db_password);
	}

	public function userLogin($username, $password)
	{

		try {
			// check username exist or not
			$sql = "SELECT username FROM users WHERE username='$username'";
			$result = $this->connection->prepare($sql);
			$result->execute();
			$checkRow = $result->rowCount();

			if ($checkRow > 0) {
				// login process starts
				$sql = "SELECT username, password FROM users WHERE username='$username'";
				$result = $this->connection->prepare($sql);
				$result->execute();

				$row = $result->fetch(PDO::FETCH_ASSOC); //fetch array
				$stored_password = $row['password'];
				$check = password_verify($password, $stored_password);

				if ($check) {
					echo "Logged In";
				} else {
					echo "Wrong Password";
				}
			} else {
				echo "No username found in database";
				exit();
			}
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function userLogout()
	{

		session_start();
		session_destroy();

		header("location:login.php");
	}
}
