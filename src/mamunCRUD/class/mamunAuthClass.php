<?php 

include 'Database.php';

class MamunAuthClass extends Database
{
	// IT IS ALWAYS GOOD PRACTICE THAT YOUR METHOD RETURNS SOMETHING
	
	public function register($username = 'Mamun', $password = '123456')
	{
		$password = password_hash($password, PASSWORD_DEFAULT);
		$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
		$sql = $this->conn->query($query);
	}

	// IT IS ALWAYS GOOD PRACTICE THAT YOUR METHOD RETURNS SOMETHING
	public function login($username, $password)
	{
		$query = "SELECT * FROM users WHERE username='{$username}' ";
		$sql = $this->conn->query($query);

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		$check = password_verify($password, $row['password']);

		if ($check) {
			echo "Logged In";
			// IF SUCCESS THE BEST PRACTICE IS STARTING A SESSION
		} else {
			echo "Wrong Password";
		}

	}

	public function logout()
	{
		
		// LOGOUT METHOD MUST NOT HAVE SESSION START, IT MUST CONTAIN ONLY UNSETTING SESSION VARIABLES AND DESTROY SESSION
		session_start();
		session_destroy();

		header("location:index.php");
	}
}

?>
