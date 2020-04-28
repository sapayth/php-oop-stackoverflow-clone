<?php 
   include_once 'inc/header.php';
   include_once 'inc/sidebar.php';
   include_once 'lib/User.php';

  
?>

<?php
     
     if(isset($_GET['id'])){
         $userid = (int)$_GET['id'];
         
        
     }

     $user = new User();
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_pass'])){
        $updatePass = $user->userPassword($userid,$_POST);
     }

?>


           

            <!--main content start-->
            <div id="content" class="ui-content ui-content-aside-overlay">
                <div class="ui-content-body">

                    <div class="ui-container">
                
                    
                        <!--page title and breadcrumb start -->
                        <div class="row">
                            <div class="col-md-8">
                                <h1 class="page-title"> Admin Dashboard
                                    <small>Change Password</small>
                                </h1>
                            </div>
                            <div class="col-md-4">
                                <ul class="breadcrumb pull-right">
                                    <li><a href="index.php"></a>Home</li>
                                    <li><a href="#" class="active">Change password</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- <h2> 
                     
                        <!--page title and breadcrumb end -->

                        <?php
                            if(isset($updatePass)){
                                echo $updatePass;
                            }
                        ?>

                      

                       <div class="row">
                       <div class="col-sm-1"></div>
                           <div class="col-sm-6 ">
                           <form class="sign-in-form" role="form" action="#" method="post">
                           <?php
                                    $sesId = Session::get("id");
                                    if($userid == $sesId){
                                    ?> 
                                    <div class="form-group">
                                         <label for="">Old Password</label>
                                        <input type="password" class="form-control"  name="old_pass">
                                    </div>

                                    <div class="form-group">
                                    <label for="">New Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>

                                    <div class="form-group">
                                    <button type="submit" name="update_pass" class="btn btn-success">Update Password</button>
                                   
                                    </div>
                                    <?php } else{
                                       "<h2>Nothing To Found</h2>";
                                    }?>

                             </form>
                           </div>
                       </div>
                    </div>              

                </div>
            </div>
            <!--main content end-->

  <?php 
   include "inc/footer.php";
   ?>