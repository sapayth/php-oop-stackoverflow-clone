<?php


spl_autoload_register(function($class_name){
    echo "$class_name"."<br/>";
    include "Classes/".$class_name.".php";
});


class ArupResetPassword{

    private $db;
    public function __construct(){
        $this->db = new AtikConnection();
         
    }


    public function emailCheck($email){
        $sql = "SELECT email FROM users WHERE email = :email";
        $query  = $this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->execute();
        if($query->rowCount() >0){
            return true;
        }else{
            return false;
        }
    }


    public function userForgotPassword($data){
        $email       = $data['email'];
        $check_email = $this->emailCheck($email);

        if( $email == "" ){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field Must not be Empty</div>";
            return $msg;
        }


        if($check_email == false){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>  Email Not Match!</div>";
            return $msg;
        }

        $result = $this->getForgotPassword($email);
        if($result){
             Session::init();
            Session::set("login",false);
            Session::set("id",$result->id);
            Session::set("name",$result->name);
            Session::set("username",$result->username);
            header("Location:create-reset-password.php");
        }else{
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Data Not Found!</div>";
            return $msg; 
        }

       }

       public function getForgotPassword($email){
        $sql = "SELECT * FROM users WHERE email = :email  LIMIT 1";
        $query  = $this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
       }
        


       public function ChangePasswordWithoutLogin($id,$data){
        $password        = $data['password'];

        if($password == ""  ){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field Must not be Empty</div>";
            return $msg;
        } 
        if(strlen($password) <6){
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Password Too short. Must Length 6 Up  !</div>";
            return $msg;
         }

         $password        = md5($data['password']);

        $sql = "UPDATE users SET
                password = :password
                WHERE id = :id";

                $query  = $this->db->pdo->prepare($sql);

                $query->bindValue(':password',$password);
                $query->bindValue(':id',$id);
        $result =  $query->execute();
        if($result){
            
            Session::set("password_change","<div class='alert alert-success'><strong>Success!</strong> Password Change!</div>");
            header("Location:login.php");
        }else{
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Not Updated !</div>";
            return $msg;
        } 
       }






   
      

	
	
}


?>