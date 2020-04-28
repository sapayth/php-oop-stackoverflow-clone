<?php
 $filepath = realpath(dirname(__FILE__));
 include_once $filepath.'/../lib/Session.php';
 include_once 'lib/User.php';

 $user = new User();

 

 Session::init();
 Session::checkSession();

 
?>

<?php

header("Cache-Control: no-cache, must-revalidate");
header("pragma:no-cache");
header("Expries:Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control:max-age=2592000");


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title>Home</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/bower_components/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="assets/bower_components/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="assets/bower_components/themify-icons/css/themify-icons.css">
        <!-- endinject -->

        <!-- Main Style  -->
        <link rel="stylesheet" href="assets/dist/css/main.css">

        <!-- Rickshaw Chart Depencencies -->
        <link rel="stylesheet" href="assets/bower_components/rickshaw/rickshaw.min.css">

        <!--easypiechart-->
        <link rel="stylesheet" href="assets/assets/js/jquery-easy-pie-chart/easypiechart.css">

        <!--horizontal-timeline-->
        <link rel="stylesheet" href="assets/assets/js/horizontal-timeline/css/style.css">


        <script src="assets/assets/js/modernizr-custom.js"></script>
    </head>
    <body>

        <div id="ui" class="ui">

            <!--header start-->
            <header id="header" class="ui-header">

                <div class="navbar-header">
                    <!--logo start-->
                    <a href="index.php" class="navbar-brand">
                        <span class="logo"><img src="assets/imgs/logo-dark.png" alt=""/></span>
                        <span class="logo-compact"><img src="assets/imgs/logo-icon-dark.png" alt=""/></span>
                    </a>
                    <!--logo end-->
                </div>

               

                <div class="search-dropdown dropdown pull-right visible-xs">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-search"></i></button>
                    <div class="dropdown-menu">
                        <form >
                            <input class="form-control" placeholder="Search here..." type="text">
                        </form>
                    </div>
                </div>

                <div class="navbar-collapse nav-responsive-disabled">

                    <!--toggle buttons start-->
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="toggle-btn" data-toggle="ui-nav" href="">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- toggle buttons end -->

                    <!--search start-->
                    <form class="search-content hidden-xs" >
                        <button type="submit" name="search" class="btn srch-btn">
                            <i class="fa fa-search"></i>
                        </button>
                        <input type="text" class="form-control" name="keyword" placeholder="Search here...">
                    </form>
                    <!--search end-->
                    <?php
                      if(isset($_GET['action']) && $_GET['action'] == "logout"){
                        Session::destroy();   
                      }
                    ?>

                    <!--notification start-->
                    <ul class="nav navbar-nav navbar-right">
                       
                     <style>
                     .role{
                         padding-top:15px;
                     }
                     </style>
                    <li class="role"><b>Role:</b>
                             <?php 
                             $id = Session::get('id');
                             $role = Session::get('role');
                              if($role ==1){
                                  echo "Admin";
                              }elseif($role == 2) {
                                  echo "Moderator";
                              }else{
                                  echo "Editor";
                              }
                             ?>
                        </li>

                        <li class="dropdown dropdown-usermenu">
                            <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <div class="user-avatar"><img src="assets/imgs/a0.jpg" alt="..."></div>
                                <span class="hidden-sm hidden-xs"><?php echo Session::get('name')?></span>
                                <!--<i class="fa fa-angle-down"></i>-->
                                <span class="caret hidden-sm hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                <li><a href="#"><i class="fa fa-cogs"></i>  Settings</a></li>
                                <li><a href="profile.php?id=<?php echo $id;?>"><i class="fa fa-user"></i>  Profile</a></li>
                                <li><a href="#"><i class="fa fa-commenting-o"></i>  Feedback</a></li>
                                 <?php
                                    if($role ==1){
                                 ?>
                                <li><a href="alluser.php"><i class="fa fa-life-ring"></i>  All User</a></li>
                                    <?php } ?>

                                <li class="divider"></li>
                                <li><a href="?action=logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
                            </ul>
                        </li>

                        <li>
                            <a data-toggle="ui-aside-right" href=""><i class="glyphicon glyphicon-option-vertical"></i></a>
                        </li>
                     
                    </ul>
                    <!--notification end-->

                </div>

            </header>
            <!--header end-->