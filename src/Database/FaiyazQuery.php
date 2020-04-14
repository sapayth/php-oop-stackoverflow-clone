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
                //Build the Dynamic Query
                $columnNames = join(',', array_keys($data));
                $columnValues = ':' . join(', :', array_keys($data));

                //Query and Execute
                $sql = "INSERT INTO $table ($columnNames) VALUES ($columnValues)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute($data);
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    ////To use these method you have to pass these 3 param and you can easily update your database info
    public function update($table, $data, $where)
    {
        try {
            //set columns
            $columns = null;
            foreach ($data as $key => $value) {
                $columns .= "$key = :$key,";
            }

            //Trim the right side of the column for avoid silly mistakes
            $columns = rtrim($columns, ',');

            //se Where
            $whereColumns = null;
            foreach ($where as $key => $value) {
                $whereColumns .= "$key = :$key,";
            }

            $whereColumns = rtrim($whereColumns, ',');

            //prepare Statement
            $sql = "UPDATE $table SET $columns WHERE $whereColumns";
            $stmt = $this->connect()->prepare($sql);

            //bind Values through foreeach loop
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            foreach ($where as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();
            return $stmt->rowCount();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

// $user = new FaiyazQuery();
// $user->update('users', $data = ['username' => 'Faiyaz15', 'password' => 'Passsword15'], $where = ['id' => 15]);
