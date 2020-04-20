<?php
namespace Src\Database;

use PDOException;

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

    //By using these get method you can easily fetch all the data from the table as associative array
    public function getAll($table)
    {
        try {
            //statement and prepare
            $sql = "SELECT * FROM $table";
            $stmt = $this->connect()->prepare($sql);

            $stmt->execute();

            //If where is empty then it will return all the row from database as array
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // By using getById method you can easily fetch a specific row from table as a associative array
    public function getById($table, $id)
    {
        try {
            //Prepare the statement
            $sql = "SELECT * FROM $table WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);

            //fetch data
            return $stmt->fetch();

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

    //Bu using this method you can easily delete all rows on the table by passing just table name
    public function deleteAll($table)
    {
        try {
            //Prepare the statement
            $sql = "DELETE FROM $table";
            $stmt = $this->connect()->prepare($sql);

            //execute the statement
            $stmt->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Using this method you can delete a row of a table by passing the table name and row id
    public function deleteById($table, $id)
    {
        try {
            //Prepare the statement
            $sql = "DELETE FROM $table WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);

            //execute the prepared statement
            $stmt->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function truncate($table)
    {
        try {
            $sql = "TRUNCATE TABLE $table";
            $stmt = $this->connect()->prepare($sql);
            
            $stmt->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

// $post = new FaiyazQuery();
// $post->deleteAll('posts');
