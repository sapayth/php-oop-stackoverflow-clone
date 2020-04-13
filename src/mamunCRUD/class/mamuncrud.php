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
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	// $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
		} catch (Exception $e) {
			echo 'Connection failed' . $e->getMessage();
		}
	}

	public function create()
	{
		if (isset($_POST['submit'])) {
			if (isset($_POST['title']) && isset($_POST['description'])) {

				if (!empty($_POST['title']) && !empty($_POST['description'])) {
					
					$title = trim($_POST['title']);
					$description = trim($_POST['description']);

					$query = "INSERT INTO posts (user_id, title, description) VALUES ('1', '$title', \"$description\")";
					if ($sql = $this->conn->query($query)) {
						
						echo "<script>window.location.href = 'index.php';</script>";

						// header('index.php');
					} else {
						echo "<script>alert('Failed!')</script>";

						echo "<script>window.location.href = 'index.php';</script>";
					}
				} else {
					echo "<script>alert('Fill out the form correctly!')</script>";

					echo "<script>window.location.href = 'index.php';</script>";
				}
			}
		}
	}

	public function fetch()
	{
		$data = null;

		$query = "SELECT * FROM posts";
		return $data = $this->conn->query($query);
	}

	public function read($id)
	{
		// $data = null;

		$data = $this->conn->prepare("SELECT * FROM posts WHERE id = :id");
		$data->execute(array (':id' => $id));

		foreach ($data as $value) {
			return $value;
		}
	}

	public function delete($id)
	{
		$query = "DELETE FROM posts WHERE id = $id";
		if ($sql = $this->conn->query($query)) {
			echo "<script>window.location.href = 'index.php';</script>";
			return true;
		} else {
			return false;
		}
	}
}

?>