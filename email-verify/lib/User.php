<?php

require_once 'Session.php';
require_once 'Database.php';
require_once 'emailController.php';

class User {
    private $db;
    public function __construct() {
        $this->db = new Database();

    }

    public function userRegistration( $data ) {
        $name            = $data['name'];
        $username        = $data['username'];
        $email           = $data['email'];
        $password        = $data['password'];
        $confirmpassword = $data['confirmpassword'];
        $role            = $data['role'];
        $check_email     = $this->emailCheck( $email );

        if ( $name == "" || $username == "" || $email == "" || $password == "" || $role == "" ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field Must not be Empty</div>";
            return $msg;
        }
        if ( strlen( $username ) < 4 ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Username Must Be 4 character Up</div>";
            return $msg;
        }
        if ( strlen( $password ) < 6 ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Password Too short. Must Length 6 Up  !</div>";
            return $msg;
        } elseif ( preg_match( '/[^a-z0-9_-]+/i', $username ) ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Username Must only contain alphanumerical, dashes and underscore!</div>";
            return $msg;
        }

        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) == false ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Invalid Email!</div>";
            return $msg;
        }

        if ( $check_email == true ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>  Email already exists!</div>";
            return $msg;
        }

        if ( $password != $confirmpassword ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>  Password do Not Match!</div>";
            return $msg;
        }

        $password       = md5( $data['password'] );
        $token          = bin2hex( random_bytes( 50 ) );
        $activationcode = 0;

        $sql   = "INSERT INTO users(name,username,email,password,role,activationcode,token) VALUES(:name,:username,:email,:password,:role,:activationcode,:token)";
        $query = $this->db->pdo->prepare( $sql );
        $query->bindValue( ':name', $name );
        $query->bindValue( ':username', $username );
        $query->bindValue( ':email', $email );
        $query->bindValue( ':password', $password );
        $query->bindValue( ':role', $role );
        $query->bindValue( ':activationcode', $activationcode );
        $query->bindValue( ':token', $token );
        $result = $query->execute();
        if ( $result ) {
            //send verification mail
            sendVerificationEmail( $email, $token );
            $msg = "<div class='alert alert-success'><strong>Success!</strong>  Verify your mail. check your Email!</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Registration Failed !</div>";
            return $msg;
        }

    }

    public function emailCheck( $email ) {
        $sql   = "SELECT email FROM users WHERE email = :email";
        $query = $this->db->pdo->prepare( $sql );
        $query->bindValue( ':email', $email );
        $query->execute();
        if ( $query->rowCount() > 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public function getLoginUser( $email, $password, $role ) {
        $sql   = "SELECT * FROM users WHERE email = :email AND password = :password AND role = :role AND activationcode='1' LIMIT 1";
        $query = $this->db->pdo->prepare( $sql );
        $query->bindValue( ':email', $email );
        $query->bindValue( ':password', $password );
        $query->bindValue( ':role', $role );
        $query->execute();

        $result = $query->fetch( PDO::FETCH_OBJ );
        return $result;
    }

    public function userLogin( $data ) {
        $email       = $data['email'];
        $password    = md5( $data['password'] );
        $role        = $data['role'];
        $check_email = $this->emailCheck( $email );

        if ( $email == "" || $password == "" || $role == "" ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field Must not be Empty</div>";
            return $msg;
        }

        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) == false ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Invalid Email!</div>";
            return $msg;
        }

        if ( $check_email == false ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>  Email Not exists!</div>";
            return $msg;
        }

        $result = $this->getLoginUser( $email, $password, $role );
        if ( $result ) {
            Session::init();
            Session::set( "login", true );
            Session::set( "id", $result->id );
            Session::set( "name", $result->name );
            Session::set( "role", $result->role );
            Session::set( "username", $result->username );
            Session::set( "login_msg", "<div class='alert alert-success'><strong>Success!</strong> Login Succesfully!</div>" );
            header( "Location:index.php" );
        } else {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Data Not Found!</div>";
            return $msg;
        }

    }

    public function getUserData() {
        $sql   = "SELECT * FROM users ORDER BY id DESC";
        $query = $this->db->pdo->prepare( $sql );
        $query->execute();
        $result = $query->fetchall();
        return $result;

    }

    public function getUserById( $userid ) {
        $sql   = "SELECT * FROM users WHERE id =:id LIMIT 1";
        $query = $this->db->pdo->prepare( $sql );
        $query->bindValue( ':id', $userid );
        $query->execute();
        $result = $query->fetch( PDO::FETCH_OBJ );
        return $result;
    }

    public function userUpdate( $id, $data ) {
        $name        = $data['name'];
        $username    = $data['username'];
        $email       = $data['email'];
        $check_email = $this->emailCheck( $email );

        if ( $name == "" || $username == "" || $email == "" ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field Must not be Empty</div>";
            return $msg;
        }
        if ( strlen( $username ) < 4 ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Username Must Be 4 character Up</div>";
            return $msg;
        } elseif ( preg_match( '/[^a-z0-9_-]+/i', $username ) ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Username Must only contain alphanumerical, dashes and underscore!</div>";
            return $msg;
        }

        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) == false ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Invalid Email!</div>";
            return $msg;
        }
        // if($check_email == true){
        //     $msg = "<div class='alert alert-danger'><strong>Error!</strong>  Email already exists!</div>";
        //     return $msg;
        // }

        $sql = "UPDATE users SET
                name = :name,
                username = :username,
                email = :email
                WHERE id = :id";

        $query = $this->db->pdo->prepare( $sql );

        $query->bindValue( ':name', $name );
        $query->bindValue( ':username', $username );
        $query->bindValue( ':email', $email );
        $query->bindValue( ':id', $id );
        $result = $query->execute();
        if ( $result ) {
            $msg = "<div class='alert alert-success'><strong>Success!</strong>  User Data Updated!</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Not Updated !</div>";
            return $msg;
        }
    }

    public function checkPassword( $id, $old_pass ) {
        $password = md5( $old_pass );
        $sql      = "SELECT password FROM users WHERE id = :id AND password = :password  ";
        $query    = $this->db->pdo->prepare( $sql );
        $query->bindValue( ":id", $id );
        $query->bindValue( ":password", $password );
        $query->execute();
        if ( $query->rowCount() > 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public function userPassword( $id, $data ) {
        $old_pass = $data['old_pass'];
        $new_pass = $data['password'];

        $chk_pass = $this->checkPassword( $id, $old_pass );

        if ( $old_pass == "" || $new_pass == "" ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>  Field Must Not Be Empty !</div>";
            return $msg;
        }

        if ( $chk_pass == false ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>Old Password Not Exist !</div>";
            return $msg;
        }
        if ( strlen( $new_pass ) < 6 ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Password Too short. Must Length 6 Up  !</div>";
            return $msg;
        }

        $password = md5( $data['password'] );

        $sql = "UPDATE users SET
            password = :password
            WHERE id = :id";

        $query = $this->db->pdo->prepare( $sql );

        $query->bindValue( ':password', $password );
        $query->bindValue( ':id', $id );
        $result = $query->execute();
        if ( $result ) {
            $msg = "<div class='alert alert-success'><strong>Success!</strong>  Password Updated!</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Not Updated !</div>";
            return $msg;
        }

    }

    public function userForgotPassword( $data ) {
        $email       = $data['email'];
        $check_email = $this->emailCheck( $email );

        if ( $email == "" ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field Must not be Empty</div>";
            return $msg;
        }

        if ( $check_email == false ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong>  Email Not Match!</div>";
            return $msg;
        }

        $result = $this->getForgotPassword( $email );
        if ( $result ) {
            Session::init();
            Session::set( "login", false );
            Session::set( "id", $result->id );
            Session::set( "name", $result->name );
            Session::set( "username", $result->username );
            Session::set( "login_msg", "<div class='alert alert-success'><strong>Success!</strong> Login Succesfully!</div>" );
            header( "Location:create-reset-password.php" );
        } else {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Data Not Found!</div>";
            return $msg;
        }

    }

    public function getForgotPassword( $email ) {
        $sql   = "SELECT * FROM users WHERE email = :email  LIMIT 1";
        $query = $this->db->pdo->prepare( $sql );
        $query->bindValue( ':email', $email );
        $query->execute();

        $result = $query->fetch( PDO::FETCH_OBJ );
        return $result;
    }

    public function ChangePasswordWithoutLogin( $id, $data ) {
        $password = $data['password'];

        if ( $password == "" ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Field Must not be Empty</div>";
            return $msg;
        }
        if ( strlen( $password ) < 6 ) {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Password Too short. Must Length 6 Up  !</div>";
            return $msg;
        }

        $password = md5( $data['password'] );

        $sql = "UPDATE users SET
                password = :password
                WHERE id = :id";

        $query = $this->db->pdo->prepare( $sql );

        $query->bindValue( ':password', $password );
        $query->bindValue( ':id', $id );
        $result = $query->execute();
        if ( $result ) {
            //$msg = "<div class='alert alert-success'><strong>Success!</strong>  Password Change</div>";
            Session::set( "password_change", "<div class='alert alert-success'><strong>Success!</strong> Password Change!</div>" );
            header( "Location:login.php" );
            //return $msg;
        } else {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Not Updated !</div>";
            return $msg;
        }
    }

    public function verifyUser( $token ) {

        $sql   = "SELECT * FROM users WHERE token = '$token' LIMIT 1  ";
        $query = $this->db->pdo->prepare( $sql );
        $query->bindValue( ":token", $token );
        $query->execute();
        if ( $query->rowCount() > 0 ) {
            return true;
        } else {
            return false;
        }

        $sql = "UPDATE users SET activationcode = 1  WHERE token = '$token'";

        $query = $this->db->pdo->prepare( $sql );

        $query->bindValue( ':activationcode', 1 );

        $result = $query->execute();
        if ( $result ) {
            Session::init();
            Session::set( "activationcode", 1 );
            Session::set( "login_msg", "<div class='alert alert-success'><strong>Success!</strong> Login Succesfully!</div>" );
            header( "location:login.php" );
        } else {
            $msg = "<div class='alert alert-danger'><strong>Error!</strong> Not Updated !</div>";
            return $msg;
        }

    }

}

?>