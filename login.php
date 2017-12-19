<?php
session_start(); //session values for logged in username

include "DAL/Users.php";
include "php/sessionmanager.php";

if(SessionManager::getActiveId() > 0) {
  header("location:admintheme/pages/index.php");
}
else {
}
// If user hits submit

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $returnvalue = true;
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


  if($returnvalue)
  {
    $connect = mysqli_connect("localhost", "root", "", "DevData");
    $query = "SELECT * FROM Users WHERE Username = '$uname'";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result)) {
        $activefirstname = $row["FirstName"];
        $activeuserid = $row["UserID"];
        $activepassword = $row["Password"];
      }
      if(password_verify($pword, $activepassword)) {
        SessionManager::setActiveId($activeuserid);
        SessionManager::setFirstName($activefirstname);
        echo '<script>alert("Log In Success!")</script>';
        header("location:/admintheme/pages/index.php");

      } else {
          echo '<script>alert("Incorrect username or password")</script>';
      }
    //  echo '<script>alert("success")</script>';
    }

    else {
echo '<script>alert("Account not detected")</script>';
    }

  }
}

 ?>




<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>
  <body>
<?php include "navbar.php"; ?>



<div class="container" style="padding-top: 120px;">
<div class="row">
<div class="col-lg-4 mx-auto">
<div class="text-center">
 <form method="post">
  <div class="form-group">
  	<label for="username">Username</label>
    <input type="username" class="form-control" name="username" placeholder="Enter Your Username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
  </div>

  <input type="submit" name="login" class="btn btn-primary" value="Log In" />
</form>

</div>
</div>
</div>
</div>

<!-- Footer -->
<footer style="padding-top: 120px;">
  <div class="container text-center">
    <p>Copyright &copy; Skyy Builds 2017</p>
  </div>
</footer>
</body>
</html>
