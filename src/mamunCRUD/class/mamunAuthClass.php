<?php 

include 'Database.php';

class MamunAuthClass extends Database
{
	public function register($username = 'Mamun', $password = '123456')
	{
		$password = password_hash($password, PASSWORD_DEFAULT);
		$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
		$sql = $this->conn->query($query);
	}

	public function login($username, $password)
	{
		$query = "SELECT * FROM users WHERE username='{$username}' ";
		$sql = $this->conn->query($query);

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		$check = password_verify($password, $row['password']);

		if ($check) {
			echo "Logged In";
		} else {
			echo "Wrong Password";
		}

	}

	public function logout()
	{

		session_start();
		session_destroy();

		header("location:index.php");
	}
}

?>