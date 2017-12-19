<?php
// Begin validation
$returnvalue = true;
/*if($_POST["email"] == "") {
	$returnvalue = false;
}
else {
	$email = $_POST["email"];
} */
if($_POST["username"] == "") {
	$returnvalue = false;
}
else {
	$uname = $_POST["username"];
}
if($_POST["password"] == "") {
	$returnvalue = false;
}
else {
	$pword = $_POST["password"];
}

//end validation
if($returnvalue)
{
	//return val passed validation so run query
	include 'databaseinfo.php';

	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}



	$command = "SELECT Username, FirstName, RoleID FROM `Users` WHERE username = '$uname' AND password = '$pword'";
  $dataset = $conn->query($command);
  if ($dataset->num_rows > 0) {
		while ($row = $dataset->fetch_assoc()) {
			$activeuserid = $row["UserID"];
			$userfirstname = $row["FirstName"];
		}
		session_start(); //session values for logged in username
		$_SESSION["UserID"] = $activeuserid;
		$_SESSION["FirstName"] = $userfirstname;
    header("location:../profile.php");
  } else {
 header("location:../login.php");
}

}
else {
	//else show validation
	header("location:../login.php");
}



?>
