<?php
/**
 * Created by PhpStorm.
 * User: Hira
 * Date: 4/11/2020
 * Time: 11:08 AM
 */

class AtikConnection
{
    protected $db;
    private $hostname, $username, $password, $database;


    /**
     * AtikConnection constructor.
     * @param $hostname
     * @param $username
     * @param $password
     * @param $database
     */
    public function __construct($hostname, $username, $password, $database)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connect();

    }

    public function __sleep()
    {
        return [$this->hostname, $this->username, $this->password, $this->database];
    }

    public function __wakeup()
    {
        $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:host={$this->hostname};
                dbname={$this->database};";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, # convert error to exception
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC   # set default fetch mode associative array
        ];

        try {
            $this->db = new PDO($dsn, $this->username, $this->password, $options);
            #echo "Connected";
        } catch (Exception $e) {
            die("Connection failed" . $e->getMessage());
        }

    }

    public function getConnection(){
        if(!isset($this->db))
            $this->connect();
        return $this->db;
    }

}
