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
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
        $userupdate = $user->userUpdate($userid,$_POST);
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
                                    <small>Profile</small>
                                </h1>
                            </div>
                            <div class="col-md-4">
                                <ul class="breadcrumb pull-right">
                                    <li><a href="index.php"></a>Home</li>
                                    <li><a href="#" class="active">Profile</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- <h2> 
                     
                        <!--page title and breadcrumb end -->

                        <?php
                            if(isset($userupdate)){
                                echo $userupdate;
                            }
                        ?>

                        <?php
                           $userdata = $user->getUserById($userid);
                           if($userdata){ 

                         
                        ?>

                       <div class="row">
                       <div class="col-sm-1"></div>
                           <div class="col-sm-6 ">
                           <form class="sign-in-form" role="form" action="#" method="post">

                            <?php
                                    $sesId = Session::get("id");
                                    $role = Session::get("role");
                                    if($userid == $sesId){

                                       
                                    ?> 

                                    <div class="form-group">
                                    <label for="">Name</label>
                                        <input type="text" class="form-control" value="<?php echo $userdata->name;?>" name="name">
                                    </div>

                                    <div class="form-group">
                                    <label for="">User Name</label>
                                        <input type="text" class="form-control" value="<?php echo $userdata->username;?>" name="username">
                                    </div>

                                    <div class="form-group">
                                       <label for="">Email</label>
                                        <input type="text" class="form-control" value="<?php echo $userdata->email;?>" name="email">
                                    </div>

                                   

                                    <div class="form-group">
                                    <button type="submit" name="update" class="btn btn-success">Update</button>
                                      <a href="change_password.php?id=<?php  echo $userid;?>" class="btn btn-info">Change Password</a>
                                    </div>

                                  
                                <?php } ?>

                                     </form>
                           </div>
                       </div>

                     

                           <?php } ?>
                       
                   

                    </div>

               

                </div>
            </div>
            <!--main content end-->

  <?php 
   include "inc/footer.php";
   ?>