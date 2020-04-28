<?php

class FaiyazRolePermission extends FaiyazQuery
{

    public function createPermission($permission = 'Delete')
    {
        try{

            $db = $this->connect();

            $sql = "INSERT into permissions (permission) VALUES (:permission)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':permission', $permission);
            $stmt->execute();

            $lastPermissionId = $db->lastInsertId();

            $role_id = 1;

            if($stmt->rowCount() > 0){

                $sql = "INSERT INTO role_permission (role_id, permission_id) VALUES (:role_id, :permission_id)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':role_id',  $role_id);
                $stmt->bindParam(':permission_id', $lastPermissionId);
                $stmt->execute();

            }

        }catch(PDOException $e){
           $e->getMessage();
        }
    }

    public function DeleteAction($table) // parameter optional
    {
      // DO A QUERY LIKE :  SELECT * FROM ROLE_PERMISSION WHERE ROLE_ID = USER_ROLE_ID AND PERMISSION_ID= THE ID OF DELETE TABLE ROW
      
      // IF FOUND THEN USER CAN DELETE OTHERWISE NOT
    }
}
