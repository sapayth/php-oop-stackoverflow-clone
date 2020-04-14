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

    public function get($table, array $data, $where = null)
    {
        try {

            //set column
            $columnName = join(',', $data);

            //check if where is not null
            if ($where != null) {
                $whereFields = null;
                foreach ($where as $key => $value) {
                    $whereFields .= "$key = :$key,";
                }

                //Trim the right side of the where field to avoid silly error
                $whereFields = rtrim($whereFields, ',');

                //set the where field
                $whereFields = "WHERE $whereFields";
            } else {
                $whereFields = null;
            }

            //statement and prepare
            $sql = "SELECT $columnName FROM $table $whereFields";
            $stmt = $this->connect()->prepare($sql);

            //check if where is empty or not then conditonally bind value and execute
            if ($where != null) {
                foreach ($where as $key => $value) {
                    $stmt->bindValue(":$key", $value);
                }
            }

            $stmt->execute();

            //If where is empty then it will return all the row from database as array
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    ////To use these method you have to pass these 3 param and you can easily update your database info
    public function update($table, array $data, $where)
    {
        try {
            //set columns
            $columns = null;
            foreach ($data as $key => $value) {
                $columns .= "$key = :$key,";
            }

            //Trim the right side of the column to avoid silly error
            $columns = rtrim($columns, ',');

            //set Where
            $whereColumns = null;
            foreach ($where as $key => $value) {
                $whereColumns .= "$key = :$key,";
            }

            //Trim the right side of the column to avoid silly error
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

    public function delete($table, $where)
    {
        try {
            //set Where 
            $whereColumns = null;
            foreach ($where as $key => $value) {
                $whereColumns .= "$key = :$key,";
            }

            //trim the right side of the where column to avoid silly errors
            $whereColumns = rtrim($whereColumns, ',');

            //prepare the statement
            $sql = "DELETE FROM $table WHERE $whereColumns";
            $stmt = $this->connect()->prepare($sql);

            //binding value through foreach loop
            foreach ($where as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

// $user = new FaiyazQuery();
// $user->delete('users', ['id' => 8]);
