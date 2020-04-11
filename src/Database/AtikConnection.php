<?php
/**
 * Created by PhpStorm.
 * User: Hira
 * Date: 4/11/2020
 * Time: 11:08 AM
 */

class AtikConnection implements ConnectionInterface
{
    protected $db;
    private $hostname, $username, $password, $database, $charset;


    /**
     * AtikConnection constructor.
     * @param $hostname
     * @param $username
     * @param $password
     * @param $database
     * @param string $charset
     */
    public function __construct($hostname, $username, $password, $database, $charset = "utf8mb4")
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->charset = $charset;
        $this->connect();

    }

    public function __sleep()
    {
        return [$this->hostname, $this->username, $this->password, $this->database, $this->charset];
    }

    public function __wakeup()
    {
        $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:host={$this->hostname};
                dbname={$this->database};
                charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, # convert error to exception
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC   # set default fetch mode associative array
            #PDO::ATTR_EMULATE_PREPARES      => false
        ];

        try {
            $this->db = new PDO($dsn, $this->username, $this->password, $options);
            #echo "Connected";
        } catch (Exception $e) {
            die("Connection failed" . $e->getMessage());
        }

    }

    public function getDB(){
        if(!isset($this->db))
            $this->connect();
        return $this->db;
    }

}
