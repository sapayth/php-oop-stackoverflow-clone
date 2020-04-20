<?php
namespace Src\Database;

use PDO;
use PDOException;

class NaowasQuery
{
    private $dbhost = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "stack_overflow_clone";
    public $connect_db;

    public function __construct()
    {

        if (!isset($this->connect_db)) {

            try {
                $this->connect_db = new PDO('mysql:host=$dbhost;dbname=$dbname', $this->username, $this->password);

                $this->connect_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "DB Connected to localhost";

            } catch (PDOException $e) {
                echo "Connection failed for localhost: " . $e->getMessage();
            }

        }

    }

    public function getAll($tableName)
    {

        $query = $this->connect_db->query("select * $tableName");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($results as $value) {
            return $value;
        }

    }

    public function getById($id, $tableName)
    {
        $query = $this->connect_db->query("SELECT * FROM $tableName WHERE id = $id");
        $query->execute([$id]);
        $results = $query->fetch(PDO::FETCH_OBJ);
        foreach ($results as $value) {
            return $value;
        }
    }

    public function insert($tableName)
    {
        if (isset($_POST['submit'])) {
            $query = $this->connect_db->query("");
        }
    }

    public function droptable($tableName)
    {
        $query = $this->connect_db->query("RUNCATE TABLE $tableName");
        $query->execute();

    }

    public function deleteById($tableName, $id)
    {
        $query = $this->connect_db->query("DELETE FROM $tableName WHERE id = $id");
        $query->execute([$id]);
        if ($query = $this->connect_db->query($query)) {
            echo "Success";
        } else {
            echo "Failed";
        }

    }

    public function deleteAll($tableName)
    {
        $query = $this->connect_db->query("DELETE * FROM $tableName");
        $query->execute();
        if ($query = $this->connect_db->query($query)) {
            echo "Success";
        } else {
            echo "Failed";
        }
    }

}
