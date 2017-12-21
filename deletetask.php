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
  header("location:../../login.php");


}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $taskid = $_POST['taskid'];
 echo '<script>alert("Task Deleted!")</script>';
 $delete = Tasks::remove($taskid);
 header("location:/admintheme/pages/user_tasks.php");
 
}

?>
