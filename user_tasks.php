<?php

session_start();

include "../../DAL/Users.php";
include "../../DAL/Projects.php";
include "../../DAL/Tasks.php";
include "../../DAL/StatusTypes.php";
include "../../php/sessionmanager.php";
include "../../php/Notification.php";
include "../../php/notificationstypes.php";

if(SessionManager::getActiveId() > 0) {
$activefirstname = SessionManager::getFirstName();
$activeuserid = SessionManager::getActiveId();
}
else {
  header("location:login.php");


}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['istask']) && $_POST['istask'] == "true") {
    //^^^ This code checks if the user entered anything into the Projects Modal. If not this code below runs
     $returnvalue = true;


     $_POST["taskname"] == "" ? $returnvalue = false : $TName = $_POST["taskname"];
     $_POST["taskdescription"] == "" ? $returnvalue = false : $TDescription = $_POST["taskdescription"];
     $Uselect = $_POST["userselect"];
     $Pselect = $_POST["projectselect"];
    // $Sselect = $_POST["statustypeselect"];
     $startdate = $_POST["startdate"];
     $enddate = $_POST["duedate"];

    if ($returnvalue) {
      $user = new Tasks();   // Create user object
      $user->setTaskID(0);
      $user->setTaskName($TName);
      $user->setTaskDescription($TDescription);
      $user->setProjectID($Pselect);
      $user->setStatusTypeID(1);
      $user->setStartDate($startdate);
      $user->setEndDate($enddate);
      $user->setUserID($Uselect);
      $user->save();
      $notif = new Notification();
      $notif->setNotificationID(0);
      $notif->setNotificationTypeID(2);
      $notif->setUserID($activeuserid);
      $notif->setProjectID(NULL);
      $notif->setTaskID($user->getTaskID());
      $notif->save();
      echo '<script>alert("Task Created!")</script>';
      //header('location: index.php');

    }
  }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>All Projects</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Hello, <?php echo $activefirstname; ?>!</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="user_projects.php"><i class="fa fa-folder-open fa-fw"></i> Projects</a>
                        </li>
                        <li>
                            <a href="user_tasks.php"><i class="fa fa-tasks fa-fw"></i> My Tasks</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-plus-square fa-fw"></i> Resources<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level-main">
                              <li>
                                  <a href="#"><i class="fa fa-bold fa-fw"></i> Bootstrap<span class="fa arrow"></span></a>
                                  <ul class="nav nav-third-level-main">
                                    <li>
                                        <a href="http://getbootstrap.com/docs/4.0/getting-started/introduction/"><i class="fa fa-external-link fa-fw"></i> Documentation</a>
                                    </li>
                                    <li>
                                        <a href="https://startbootstrap.com"><i class="fa fa-sitemap fa-fw"></i> Templates</a>
                                    </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="morris.html">Morris.js Charts</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="panels-wells.html">Panels and Wells</a>
                                </li>
                                <li>
                                    <a href="buttons.html">Buttons</a>
                                </li>
                                <li>
                                    <a href="notifications.html">Notifications</a>
                                </li>
                                <li>
                                    <a href="typography.html">Typography</a>
                                </li>
                                <li>
                                    <a href="icons.html"> Icons</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grid</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>

                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.html">Blank Page</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                      </ul>
                      <li>
                          <a href="#"><i class="fa fa-html5 fa-fw"></i> HTML<span class="fa arrow"></span></a>
                          <ul class="nav nav-third-level-main">
                            <li>
                                <a href="https://www.w3schools.com/html/default.asp">W3 Schools</a>
                            </li>
                            <li>
                                <a href="blank.html">Code Academy</a>
                            </li>
                          </ul>
                        </li>
                    </ul>
                  </li>


                </ul>
              </li>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">My Tasks</h1>
                  </div>
                  <div class="col-lg-6">
                  <!--  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#projectModal">
                    Create Project
                  </button> -->
                 <button type="button" class="btn btn-info" data-toggle="modal" data-target="#taskModal">
                    Create Task
                  </button>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <br>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-folder-openfa-fw"></i> All Tasks
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Update</a>
                                        </li>
                                        <li><a href="#">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <div class="col-sm-3">
                              <thead>
                                  <tr>
                                      <th style="text-align: center;">Task ID</th>
                                      <th style="text-align: center;">Task Name</th>
                                      <th style="text-align: center;">Task Description</th>
                                      <th style="text-align: center;">Project Name</th>
                                      <th style="text-align: center;">Status</th>
                                      <th style="text-align: center;">Close Task</th>
                                      <th style="text-align: center;">Edit Task</th>
                                      <th style="text-align: center;">Delete Task</th>

                                  </tr>
                              </thead>
                          <?php

                            $tasklist = Tasks::loadByAccountID($activeuserid);
                            foreach ($tasklist as $info) {
                              $taskid = $info->getTaskID();
                              $taskname = $info->getTaskName();
                              $taskdescription = $info->getTaskDescription();
                              ?>
                              <tr>
                                  <td style="text-align: center;">
                              <?php
                              echo $taskid;
                                ?> </td>
                                <td style="text-align: center;">
                            <?php
                            echo $taskname;
                              ?> </td>
                                <td style="text-align: center;">
                                  <?php
                              echo $taskdescription;
                              ?>
                            </td>
                            <td style="text-align: center;">
                              <?php
                              $projectname = new Projects();
                               $projectname->load($info->getProjectID());
                               echo $projectname->getProjectName();
                          ?>
                        </td>
                        <td style="text-align: center;">
                          <?php
                          $statusname = new StatusTypes();
                           $statusname->load($info->getStatusTypeID());
                           echo $statusname->getStatusName();
                      ?>
                    </td>
                    <td>
                      <?php if($info->getStatusTypeID() == 1) { ?>
                      <div align="center">
                      <form action="closetask.php" method="post">
                      <button id="close" type="submit" class="btn btn-success">
                         Close
                       </button>
                         <input type="hidden" name="taskid" value="<?php echo $info->getTaskID(); ?>">
                       </form>
                     </div>
                    <?php } else { ?>
                        <div align="center">
                         <form action="opentask.php" method="post">
                         <button id="close" type="submit" class="btn btn-primary">
                            Open
                          </button>
                            <input type="hidden" name="taskid" value="<?php echo $info->getTaskID(); ?>">
                          </form>
                        </div>
                       <?php } ?>

                    </td>
                    <td>
                      <div align="center">

                    <a href="edittask.php?id=<?php echo $taskid ?>"> <button id="edit" class="btn btn-warning">
                         Edit
                       </button> </a>
                         <input type="hidden" name="taskid" value="<?php echo $info->getTaskID(); ?>">
                         <input type="hidden" name="taskname" value="<?php echo $info->getTaskName(); ?>">
                         <input type="hidden" name="taskdesc" value="<?php echo $info->getTaskDescription(); ?>">
                       </form>
                       </div>
                    </td>
                    <td>
                      <div align="center">
                      <form action="deletetask.php" method="post">
                      <button id="delete" type="submit" class="btn btn-danger">
                         Delete
                       </button>
                         <input type="hidden" name="taskid" value="<?php echo $info->getTaskID(); ?>">
                       </form>
                       </div>
                    </td>
                  </tr>
                          </div>
                              <?php
                            }
                            ?>
                          </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>


                    <!-- /.panel -->
                </div>

                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- Project Modal -->
    <div class="modal fade" id="projectModal" style="color: #000;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create a New Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <!--Form-->
        <form method="post">
          <input id="hfisproject" type="hidden" name="isproject">
         <div class="form-group">
           <label for="projectname">Project Name</label>
           <input type="projectname" class="form-control" name="projectname" aria-describedby="emailHelp" placeholder="Enter the project name">
           <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
         </div>
         <div class="form-group" style="color: #000;">
          <label for="projectdescription">Project Description</label>
           <textarea class="form-control" name="projectdescription" placeholder="Enter a project description" rows="3"></textarea>
         </div>
         <div class="form-group">
           <label for="companyselect">Select Company</label>
           <select class="form-control" name="companyselect">
             <option value="0">Skyy Builds</option>
             <option value="1">Web Media Concepts</option>
             <option value="2">Other</option>
          </select>
         </div>
         <div class="form-group">
          <label for="website">Website</label>
           <input type="website" class="form-control" name="website" placeholder="Enter website">
         </div>





      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="projectbutton" onclick="return setform(this.id);" type="submit" class="btn btn-primary">Create</button>
      </div>
       </form>
        </div>
    </div>
    </div>
    </div>

    <!-- Task Modal -->
    <div class="modal fade" id="taskModal" style="color: #000;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create a New Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <!--Form-->
        <form method="post">
          <input id="hfistask" type="hidden" name="istask" >
         <div class="form-group">
           <label for="taskname">Task Name</label>
           <input type="taskname" class="form-control" name="taskname"  placeholder="Enter the task name">
           <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
         </div>
         <div class="form-group" style="color: #000;">
          <label for="taskdescription"> Task Description</label>
           <textarea class="form-control" name="taskdescription" placeholder="Enter a task description" rows="3"></textarea>
         </div>
         <div class="form-group">
           <label for="userselect">Select Assignee</label>
           <select class="form-control" name="userselect">
             <?php
             $userlist = Users::loadall();
             foreach ($userlist as $ul) {
                $assigneeID = $ul->getUserID();
                $UserUsername = $ul->getUsername();
                $UserFirstname = $ul->getFirstName();
                $UserLastname = $ul->getLastName();
                echo "<option value='$assigneeID'>";
                echo $UserUsername.", ".$UserFirstname." ".$UserLastname;
                echo "</option>";
        }
              ?>
          </select>
         </div>
         <div class="form-group">
           <label for="projectselect">Select Project</label>
           <select class="form-control" name="projectselect">
             <?php
             $projectlist = Projects::loadall();
             foreach ($projectlist as $pj) {
              $PID = $pj->getProjectID();
              $PjtName = $pj->getProjectName();;
              echo "<option value='$PID'>$PjtName</option>";
             }
              ?>
          </select>
         </div>


         <div class="form-group" style="color: #000;">
          <label for="startdate">Start Date</label>
           <input class="form-control" name="duedate" placeholder="mm/dd/yyyy"></input>
         </div>
         <div class="form-group" style="color: #000;">
          <label for="duedate">Due Date</label>
           <input class="form-control" name="startdate" placeholder="mm/dd/yyyy"></input>
         </div>



      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="taskbutton" onclick="return setform(this.id);" type="submit" class="btn btn-success">Create</button>
      </div>
    </form>
        </div>
    </div>
    </div>
    </div>

<!--- Function to know which button is being pressed on; Create Project/Task-->
<script>

function setform(el) {
  switch (el) {
    case "projectbutton":
    $("#hfisproject").val("true");
      break;
    case "taskbutton":
    $("#hfistask").val("true");
    break;
    default: return false;

  }
  return true;
}

</script>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
