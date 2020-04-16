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

    public function BasicQuery($tableName)
    {

        $query = $this->connect_db->query("select * comments");
        $query->bindParam(":tableName", $tableName);
        $query->execute();

    }

}