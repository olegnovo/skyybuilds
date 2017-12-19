<?php

include "DAL/Users.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Begin validation
  $returnvalue = true;
  $connect = mysqli_connect("localhost", "root", "", "DevData");
  $_POST["email"] == "" ? $returnvalue = false : $email = mysqli_real_escape_string($connect, $_POST["email"]);
  $_POST["username"] == "" ? $returnvalue = false : $uname = mysqli_real_escape_string($connect, $_POST["username"]);
  $_POST["password"] == "" ? $returnvalue = false : $pword = mysqli_real_escape_string($connect, $_POST["password"]);
  $_POST["firstname"] == "" ? $returnvalue = false : $firstname = mysqli_real_escape_string($connect, $_POST["firstname"]);
  $_POST["lastname"] == "" ? $returnvalue = false : $lastname = mysqli_real_escape_string($connect, $_POST["lastname"]);
  $selectrole = $_POST["selectrole"];
  $pword = password_hash($pword, PASSWORD_DEFAULT);

 if ($returnvalue) {
   // Check if username is already taken
//   $servername = "localhost";
//   $username = "root";
//   $password = "";
//   $dbname = "DevData";
//   $conn = new mysqli($servername, $username, $password, $dbname);
//   $query = "SELECT Username FROM Users WHERE Username = '$uname';";
//   $result = $conn->query($query);
  $takenname = Users::search("","",$uname,"","","","","","");
//   if(mysqli_num_rows($result) > 0){
  if (!empty($takenname)) {
     echo '<script>alert("This username is taken. Please select another.")</script>';
   } else {
  $user = new Users();   // Create user object
   $user->setUserID(0);
   $user->setEmail($email);
   $user->setUsername($uname);
   $user->setPassword($pword);
   $user->setFirstName($firstname);
   $user->setLastName($lastname);
   $user->setRoleID($selectrole);
   $user->save();
   header("location:login.php");
  
 }
 }
  else echo '<script>alert("All fields required")</script>';
}

?>


<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
  <body>
<?php include "navbar.php"; ?>
<body>
<br>
<br>
<div class="container" style="padding-top: 80px;">
<div class="row">
<div class="col-lg-4 mx-auto">
<div class="text-center">
 <form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email">
    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group">
  	<label for="username">Username</label>
    <input type="username" class="form-control" name="username" placeholder="Enter desired username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
  </div>
  <div class="form-group">
  	<label for="firstname">First Name</label>
    <input type="firstname" class="form-control" name="firstname" placeholder="First name">
  </div>
   <div class="form-group">
  	<label for="lastname">Last Name</label>
    <input type="lastname" class="form-control" name="lastname" placeholder="Last name">
  </div>
  <div class="form-group">
    <label for="roleselect">Select role</label>
    <select class="form-control" name="selectrole">
      <option value = "0">Developer</option>
      <option value = "1">Client</option>
	  </select>
	 </div>
  <div class="form-check">


  </div>
  <button type="submit" class="btn btn-primary">Register</button>

</form>
	</div>
	</div>
	</div>
	</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../olaha/js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../olaha/js/bootstrap.js"></script>
</body>
</html>
