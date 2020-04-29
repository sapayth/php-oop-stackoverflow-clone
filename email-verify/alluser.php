<?php 
   include_once 'inc/header.php';
   include_once 'inc/sidebar.php';
   include_once 'lib/User.php';

   $user = new User();

  
?>


<?php       
                                    //  if(isset($_GET['id'])){
                                    //     $userid = (int)$_GET['id'];
                                    
                                    
                                    $sesId = Session::get("role");
                                    if($role == 1){
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
                                    <small>All User List</small>
                                </h1>
                            </div>
                            <div class="col-md-4">
                                <ul class="breadcrumb pull-right">
                                    <li><a href="index.php"></a>Home</li>
                                    <li><a href="#" class="active">All User</a></li>
                                </ul>
                            </div>
                        </div>

                                
                        <!-- <h2>
                     
                        <!--page title and breadcrumb end -->

                         <table class="table table-bordered">
                            <tr>
                               <th>SL</th>
                               <th>Name</th>
                               <th>User Name</th>
                               <th>Email</th>
                               <th>Role</th>
                               <th>Action</th>
                            </tr>
                  <?php
                     $user = new User();
                     $userData = $user->getUserData();
                     if($userData){
                         $i = 0;
                         foreach($userData as $data){
                             $i++;
                             
                  ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $data['name'];?></td>
                                <td><?php echo $data['username'];?></td>
                                <td><?php echo $data['email'];?></td>
                                <td>
                                  <?php
                                    if($data['role'] ==1){
                                    echo "Admin";
                                    }elseif($data['role'] == 2) {
                                    echo "Moderator";
                                    }else{
                                    echo "Editor";
                                    }
                                 ?>
                                 </td>
                                <td>
                                   <a class="btn btn-success" href="profile.php?id=<?php echo $data['id'];?>">View</a>
                                   <a class="btn btn-danger" href="#">Deleted</a>
                                </td>
                            </tr>

                         <?php } }else{?>  
                          <tr><td><h2>No Data Found</h2></td></tr>

                         <?php }?>      
                         </table>
                       
                   

                    </div>

               

                </div>
            </div>
            <!--main content end-->
            <?php } ?>

  <?php 
   include "inc/footer.php";
   ?>