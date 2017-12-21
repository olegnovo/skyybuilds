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
$closetask = new Tasks();
$closetask->load($taskid);
$closetask->setStatusTypeID(1);
$closetask->save();
$notif = new Notification();
$notif->setNotificationID(0);
$notif->setNotificationTypeID(4);
$notif->setUserID($activeuserid);
$notif->setProjectID(NULL);
$notif->setTaskID($taskid);
$notif->save();

}

header("location:/admintheme/pages/user_tasks.php");




?>
