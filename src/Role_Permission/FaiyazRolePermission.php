<?php

namespace Src\Role_Permission;

use PDOException;
use Src\Database\FaiyazQuery;

include_once '../../autoload.php';

class FaiyazRolePermission extends FaiyazQuery
{

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

    public function CreatePost()
    {
        try {

            //Get the permission Id
            $db = $this->connect();
            $sql = "SELECT id FROM `permissions` WHERE permission = 'Can Create' ";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $permission_id = $stmt->fetchColumn();

            //Check the authenticated User Role
            $authenticated_role_id = $this->checkRole();

            //Get All the permission Id from role_permission table
            $sql = "SELECT * FROM role_permission WHERE role_id = :role_id AND permission_id= :permission_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':role_id', $authenticated_role_id);
            $stmt->bindParam(':permission_id', $permission_id);
            $stmt->execute();

            //Check if the permision exists on the table for specific role
            if ($stmt->rowCount() > 0) {

                //then do the operation
                $data = [
                    "user_id" => 1,
                    "title" => 'This is a post to test Role Permsision From Admin',
                    "body" => 'This is a post to test Role Permsision Body',
                ];

                $this->insert('posts', $data);

            } else {
                echo "You are not Authorize to create Post";
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function DeletePost()
    {
        try {

            //Get the permission Id
            $db = $this->connect();
            $sql = "SELECT id FROM `permissions` WHERE permission = 'Can Delete' ";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $permission_id = $stmt->fetchColumn();

            //Check the authenticated User Role
            $authenticated_role_id = $this->checkRole();

            //Get All the permission Id from role_permission table
            $sql = "SELECT * FROM role_permission WHERE role_id = :role_id AND permission_id= :permission_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':role_id', $authenticated_role_id);
            $stmt->bindParam(':permission_id', $permission_id);
            $stmt->execute();

            //Check if the permision exists on the table for specific role
            if ($stmt->rowCount() > 0) {

                //then do the operation
                $this->deleteById('posts', 1);

            } else {
                echo "You are not Authorize to Delete Post";
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
