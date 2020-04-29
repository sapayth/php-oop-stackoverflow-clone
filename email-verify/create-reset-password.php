<?php


include 'lib/User.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/lib/Session.php';
 Session::init();
 Session::checkLogin();
?>

<?php

$id = Session::get("id");

$user = new User();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])){
   $change_password = $user->ChangePasswordWithoutLogin($id,$_POST);
}


?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title>Login</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/bower_components/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="assets/bower_components/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="assets/bower_components/themify-icons/css/themify-icons.css">
        <!-- endinject -->

        <!-- Main Style  -->
        <link rel="stylesheet" href="assets/dist/css/main.css">

        <script src="assets/assets/js/modernizr-custom.js"></script>
    </head>
    <body>

        <div class="sign-in-wrapper">
            <div class="sign-container">
                <div class="text-center">
                    <h2 class="logo"><img src="assets/imgs/logo-dark.png" width="130px" alt=""/></h2>
                    <h4>Set New Password</h4>
                </div>

                
                <?php
                 if(isset($change_password )){
                     echo $change_password ; 
                 }
                ?>

                       

                <form class="sign-in-form" role="form" action="#" method="post">
                    
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                   
                  
                    <button type="submit" name="change_password" class="btn btn-info btn-block">Update</button>
                   
                </form>
                           
                <div class="text-center copyright-txt">
                    <small>Arup Paul</small>
                </div>
            </div>
        </div>

        <!-- inject:js -->
        <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
        <script src="assets/bower_components/autosize/dist/autosize.min.js"></script>
        <!-- endinject -->

        <!-- Common Script   -->
        <script src="assets/dist/js/main.js"></script>

    </body>
</html>
