<?php

namespace Src\Role_Permission;

use PDOException;
use Src\Authentication\FaiyazRoleBasedAuth;
use Src\Database\FaiyazQuery;

include_once '../../autoload.php';

class FaiyazRolePermission extends FaiyazRoleBasedAuth
{

    public function createPermission($permission = 'User can Delete')
    {
        try{

            $db = $this->connect();

            $sql = "INSERT into `permissions` (permission) VALUES (:permission)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':permission', $permission);
            $stmt->execute();

            $lastPermissionId = $db->lastInsertId();

            $role_id = 2;

            if($stmt->rowCount() > 0){

                $sql = "INSERT INTO `role_permission` (role_id, permission_id) VALUES (:role_id, :permission_id)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':role_id',  $role_id);
                $stmt->bindParam(':permission_id', $lastPermissionId);
                $stmt->execute();

            }

        }catch(PDOException $e){
           $e->getMessage();
        }
    }



    public function getPermissionId()
    {
        
        $authenticated_role_id = $this->checkRole();

        $db = $this->connect();
        $sql = "SELECT permission_id FROM role_permission INNER JOIN permissions ON permission_id = permissions.id
                 WHERE role_id = $authenticated_role_id";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            $permission_id = $stmt->fetchColumn();

            return $permission_id;
        }
    }

    public function DeletePost()
    {
        try {

            $db = $this->connect();

            $authenticated_role_id = $this->checkRole();
            $permission_id = $this->getPermissionId();

            $sql = "SELECT * FROM role_permission WHERE role_id = :role_id AND permission_id= :permission_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':role_id', $authenticated_role_id);
            $stmt->bindParam(':permission_id', $permission_id);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                echo "You are authorize to delete";
            }else{
                echo "You are not";
            }


        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
