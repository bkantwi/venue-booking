<?php 
 include('connect.php');
  $sql = "select * from admin where id = '".$_SESSION["id"]."'";
        $result=$conn->query($sql);
        $row1=mysqli_fetch_array($result);
       
            $q = "select * from tbl_permission_role where role_id='".$row1['group_id']."'";
            $ress=$conn->query($q);
           
             $name = array();
            while($row=mysqli_fetch_array($ress)){
            $sql = "select * from tbl_permission where id = '".$row['permission_id']."'";
            $result=$conn->query($sql);
            if(mysqli_num_rows($result) > 0){
                $row2=mysqli_fetch_array($result);
                array_push($name,$row2[1]);
            }
             }
             $_SESSION['name']=$name;
             $useroles=$_SESSION['name'];

 ?>

        <div class="left-sidebar">
            
            <div class="scroll-sidebar">
                
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <!-- <li class="nav-label">Home</li> -->
                        <!-- <li> <a href="index.php" aria-expanded="false"><i class="fa fa-window-maximize"></i>Dashboard</a> -->
                        </li>
                        <li><a href="add_allotment.php">Schedule Quiz</a></li>
                        <!-- <li><a href="view_allotment.php">View Allotment</a></li> -->

                        <?php if(isset($useroles)){  if(in_array("manage_attendence",$useroles)){ ?> 
                         <!-- <li class="nav-label">Attendence</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-clock-o"></i><span class="hide-menu">Attendence Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($useroles)){  if(in_array("add_attendence",$useroles)){ ?> 
                                <li><a href="add_attendence.php">Add Attendence</a></li>
                            <?php } } ?>
                                <li><a href="view_attendence.php">View Attendence</a></li>
                               
                            </ul>
                        </li>
                    <?php } } ?>

                    <?php if(isset($useroles)){  if(in_array("manage_class",$useroles)){ ?> 
                         <!-- <li class="nav-label">Class</li> -->
                        <!-- <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Class Management</span></a> -->
                            <!-- <ul aria-expanded="false" class="collapse"> -->
                            <?php if(isset($useroles)){  if(in_array("add_class",$useroles)){ ?> 
                                <!-- <li><a href="add_class.php">Add Class</a></li> -->
                            <?php } } ?>
                                <!-- <li><a href="view_class.php">View Class</a></li> -->
                            <!-- </ul> -->
                        <!-- </li> -->
                    <?php } } ?>

                         <?php if(isset($useroles)){  if(in_array("manage_subject",$useroles)){ ?> 
                         <!-- <li class="nav-label">Subject</li> -->
                        <!-- <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-newspaper-o"></i><span class="hide-menu">Subject Management</span></a>
                            <ul aria-expanded="false" class="collapse"> -->
                            <?php if(isset($useroles)){  if(in_array("add_subject",$useroles)){ ?> 
                                <!-- <li><a href="add_subject.php">Add Subject</a></li> -->
                            <?php } } ?>
                                <!-- <li><a href="view_subject.php">View Subject</a></li> -->
                            <!-- </ul>
                        </li> -->
                    <?php } } ?>

                    <?php if(isset($useroles)){  if(in_array("manage_exam",$useroles)){ ?> 
                                <li><a href="report_exam.php">Scheduled Quizzes</a></li>
                    <?php } } ?>
                   
                  <?php if(isset($useroles)){  if(in_array("manage_user",$useroles)){ ?> 
                         <!-- <li class="nav-label">Users</li>  -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-user-plus"></i><span class="hide-menu">User Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($useroles)){  if(in_array("add_user",$useroles)){ ?> 
                                <li><a href="add_user.php">Add Users</a></li>
                            <?php } } ?>
                                <li><a href="view_user.php">View Users</a></li>
                            </ul>
                        </li>
                    <?php } } ?>

                    <?php if($_SESSION["username"]=='admin') { ?>
                         <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-lock"></i><span class="hide-menu">User Permissions</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="assign_role.php">assign role</a></li>
                               <li><a href="view_role.php">View Role</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    </ul>   
                </nav>
            </div>
        </div>