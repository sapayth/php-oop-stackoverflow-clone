<?php

namespace StackOverflowClone\Src\Database;

use PDOException;
use StackOverflowClone\Src\Database\FaiyazConnection;

include_once '../../autoload.php';

class FaiyazQuery extends FaiyazConnection
{
    //Using these method you have to just pass the table name and value as a array. Thenv value wibb be inserted on database 
    public function insert($table, array $data)
    {
        try {
            if (is_array($data)) {
                $columnNames = join(',', array_keys($data));
                $columnValues = ':' . join(', :', array_keys($data));
                $sql = "INSERT INTO $table ($columnNames) VALUES ($columnValues)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute($data);
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}

// $user = new FaiyazQuery();
// $data = [
//     "username" => 'faiyaz',
//     "password" =>  password_hash('Pass1436', PASSWORD_DEFAULT),
// ];
// $user->insert("users", $data);
