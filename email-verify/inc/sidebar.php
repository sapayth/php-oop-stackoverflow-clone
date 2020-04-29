 <!--sidebar start-->
 <aside id="aside" class="ui-aside">
                <ul class="nav" ui-nav>
                    <li class="nav-head">
                        <h5 class="nav-title text-uppercase light-txt">Navigation</h5>
                    </li>
                    <li class="active">
                        <a href="index.html"><i class="fa fa-home"></i><span>Dashboard</span></a>
                        
                    </li>
                    <?php
                     $role = Session::get('role');
                     //$user_role = Session::get("login");
                     if($role == 1){
                     
                    ?>

                    <li>
                        <a href=""><i class="fa fa-shopping-cart"></i><span>Admin</span><i class="fa fa-angle-right pull-right"></i></a>
                       </li>
                     <?php } elseif($role==2){?>

                       <li>
                        <a href=""><i class="fa fa-shopping-cart"></i><span>Moderator</span><i class="fa fa-angle-right pull-right"></i></a>
                       </li>
                     <?php } elseif($role ==3){?>

                       <li>
                        <a href=""><i class="fa fa-shopping-cart"></i><span>Editor</span><i class="fa fa-angle-right pull-right"></i></a>
                       </li>
                     <?php } else{?>
                     <li>no found</li>
                     <?php } ?>

               
                </ul>
            </aside>
            <!--sidebar end-->