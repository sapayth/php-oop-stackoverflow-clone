<?php
include 'lib/User.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/lib/Session.php';
 Session::init();
?>

<?php

$user = new User();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
   $userReg = $user->userRegistration($_POST);
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title>Registration - MegaDin</title>

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
                    <h4>Register to Admin</h4>
                </div>

                <?php
                 if(isset($userReg )){
                     echo $userReg ; 
                 }
                ?>

                <form class="sign-in-form" role="form" action="#" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" name="name" >
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="User Name" name="username" >
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email" >
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" >
                    </div>

                       <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword" >
                    </div>

                     <div class="form-group">
                        <select class="form-control"  name="role" id="">
                            <option value="">Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Moderator</option>
                            <option value="3">Editor</option>
                        </select>
                    </div> 
                    <button type="submit" name="register" class="btn btn-info btn-block">Register</button>
                    <p class="text-muted text-center help-block"><small>Already have an account?</small></p>
                    <a class="btn btn-md btn-default btn-block" href="login.php">Login</a>
                </form>
                <div class="text-center copyright-txt">
                    <small>MegaDin - Copyright © 2017</small>
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
