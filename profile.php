
<?php
session_start(); //session values for logged in username



include "DAL/Users.php";
include "DAL/Projects.php";
include "DAL/Tasks.php";
include "DAL/StatusTypes.php";
include "php/sessionmanager.php";

if(SessionManager::getActiveId() > 0) {

}
else {
  header("location:login.php");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['isproject']) && $_POST['isproject'] == "true") {
    // Begin validation
    $returnvalue = true;


    $_POST["projectname"] == "" ? $returnvalue = false : $PName = $_POST["projectname"];
    $_POST["projectdescription"] == "" ? $returnvalue = false : $PDescription = $_POST["projectdescription"];
    $_POST["website"] == "" ? $returnvalue = false : $Web = $_POST["website"];
    $Comp = $_POST["companyselect"];

   if ($returnvalue) {
     $user = new Projects();   // Create user object
     $user->setProjectID(0);
     $user->setProjectName($PName);
     $user->setProjectDescription($PDescription);
     $user->setCompany($Comp);
     $user->setWebsite($Web);
     $user->save();
     header('location: profile.php');
   }
  }
  if (isset($_POST['istask']) && $_POST['istask'] == "true") {
    //^^^ This code checks if the user entered anything into the Projects Modal. If not this code below runs
     $returnvalue = true;


     $_POST["taskname"] == "" ? $returnvalue = false : $TName = $_POST["taskname"];
     $_POST["taskdescription"] == "" ? $returnvalue = false : $TDescription = $_POST["taskdescription"];
     $Uselect = $_POST["userselect"];
     $Pselect = $_POST["projectselect"];
     $Sselect = $_POST["statustypeselect"];
     $startdate = $_POST["startdate"];
     $enddate = $_POST["duedate"];

    if ($returnvalue) {
      $user = new Tasks();   // Create user object
      $user->setTaskID(0);
      $user->setTaskName($TName);
      $user->setTaskDescription($TDescription);
      $user->setProjectID($Pselect);
      $user->setStatusTypeID($Sselect);
      $user->setStartDate($startdate);
      $user->setEndDate($enddate);
      $user->setUserID($Uselect);
      $user->save();
      header('location: profile.php');

    }
  }




}

/*
// Sets user page to active user ONLY.
if(isset($_GET['id'])) {
  if($_GET['id'] == $activeuserid) {

  } else {
      session_destroy();
      header("location:../index.php");
  }
}


include 'php/databaseinfo.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error)
{
  die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en">

<?php
  include "head.php";
?>
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="refresh" content="0;url=admintheme/pages/index.php">
  <script language="javascript">
      window.location.href = "/admintheme/pages/index.php"
  </script>
</head>

  <body>

<?php include "navbar.php"; ?>

<div class="row">
  <div class="col-sm-12" style="text-align: center; padding-top: 120px;">
  <h2> Hello, <?php echo $userfirstname; ?>! </h2>
  <div class="row">
<!--- Show tasks on page -->
<?php
  $tasklist = Tasks::loadByAccountID($activeuserid);
  foreach ($tasklist as $task) {
?>
  <div class="col-sm-3">
<?php
    echo $task->getTaskName();
    echo $task->getTaskDescription();
    echo $task->getStartDate();
  //  echo $task->getProjectID();
    $project = new Projects();
    $project->load($task->getProjectID());
    echo $project->getProjectName();
    $status = new StatusTypes();
    $status->load($task->getStatusTypeID());
    echo $status->getStatusName();
    echo $task->getEndDate();
//    echo $task->getStatusTypeID();
  //  echo $task->getUserID();

    ?>
      </div>
    <?php

  }     // Closing bracket for the for-loop
  ?>
</div>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#projectModal">
  Create Project
  </button>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#taskModal">
  Create Task
  </button>
</div>
</div>



<!-- Footer -->
<footer>
  <div class="container text-center">
    <p>Copyright &copy; Skyy Builds 2017</p>
  </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

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
     <div class="form-group">
       <label for="statustypeselect">Select Status</label>
       <select class="form-control" name="statustypeselect">
         <?php
         $statuslist = StatusTypes::loadall();
         foreach ($statuslist as $sl) {
          $SID = $sl->getStatusTypeID();
          $StName = $sl->getStatusName();;
          echo "<option value='$SID'>$StName</option>";
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


</body>
</html>
