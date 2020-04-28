<?php 
   include_once 'inc/header.php';
   include_once 'inc/sidebar.php';

   // verify the user using token


?>


           

            <!--main content start-->
            <div id="content" class="ui-content ui-content-aside-overlay">
                <div class="ui-content-body">

                    <div class="ui-container">
                    <?php
                        $login_msg = Session::get("login_msg");
                        if(isset($login_msg)){
                            echo $login_msg;
                        }
                        Session::set("login_msg","");

                        ?>
                    
                        <!--page title and breadcrumb start -->
                        <div class="row">
                            <div class="col-md-8">
                                <h1 class="page-title"> Admin Dashboard
                                    <small>data, statistics, charts, recent reports and many more</small>
                                </h1>
                            </div>
                            <div class="col-md-4">
                                <ul class="breadcrumb pull-right">
                                    <li>Home</li>
                                    <li><a href="#" class="active">Dashboard</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- <h2>
                       <?php
                            $name = Session::get("name");
                            if(isset($name)){
                                echo $name;
                            }
                          ?></h2> -->
                        <!--page title and breadcrumb end -->

                         
                       
                   

                    </div>

               

                </div>
            </div>
            <!--main content end-->

  <?php 
   include "inc/footer.php";
   ?>