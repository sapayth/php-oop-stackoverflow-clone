<?php

namespace Src\Role_Permission;

use PDOException;
use Src\Database\FaiyazQuery;

include_once '../../autoload.php';

class FaiyazRolePermission extends FaiyazQuery
{

    public function getPermissionId()
    {

        $db = $this->connect();
        $sql = "SELECT id FROM `permissions` WHERE permission = 'Can_Delete' ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
        $permission_id = $stmt->fetchColumn();
        
        return $permission_id;
        
    }

    public function checkRole()
    {
        try {

            $user_id = $_SESSION['user_id'];

            $db = $this->connect();
            $sql = "SELECT role_id FROM role_user WHERE user_id = $user_id";
            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id]);

            $role_id = $stmt->fetchColumn(0);

            return $role_id;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkPermssion()
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
            return $stmt;

            

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function CreatePost()
    {
        try {

            $permission = $this->checkPermssion();

            if ($permission->rowCount() > 0) {

                $data = [
                    "user_id" => 2,
                    "title" => "This is role Permission Checek from User",
                    "body" => "This is role Permission Checek from User Body"
                ];
                
               //Insert Post 
                $this->insert("posts", $data);
            } else {
                echo "You are not Authorize to create Post";
            }

        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    // public function DeletePost()
    // {
    //     try {

    //         $permission = $this->checkPermssion();

    //         if ($permission->rowCount() > 0) {
                
    //             //delete post by specific id
    //             // $this->deleteById('posts', 5);

    //             echo "You are authorize to delete";

    //         } else {
    //             echo "You are not Permittedd to delete";
    //         }

    //     } catch (PDOException $e) {
    //         $e->getMessage();
    //     }
    // }
}
