<?php

session_start();

	if(!isset($_SESSION['username'])){
	header("Location: password.php");
	}
    
 if (isset($_POST['old_password']))
	{
		require './db_connection.php';

		//$sql = "INSERT INTO auto_admin WHERE username = \$_SESSION['username'] AND password = :old_password VALUES('',)"
		
		$sql = "UPDATE auto_admin SET password=:new_password WHERE username=:username AND password=:old_password;";
		
		$stmt = $dbConn -> prepare($sql);
		$stmt -> execute(array(":username" => $_SESSION['username'], ":old_password" => hash("sha1", $_POST['old_password']), ":new_password" => hash("sha1", $_POST['new_password'])));

	}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Assignment &amp; 5</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="signin.css">
     
        <script>

function confirmPassword(event) {
var logout = confirm("Do you really want to change your password?");
if (!logout) {
event.preventDefault();
}
}
</script>
  </head>
<div class="container">
<h2>Change Password</h2>
<p class="text-center">Use the form below to change your password. </p>
<form class="form-signin" method="post" id="passwordForm" onsubmit="confirmPassword()">
	<input type="password" class="input-lg form-control" name="old_password" id="old_password" placeholder="Old Password" autocomplete="off">
<br>
<input type="password" class="input-lg form-control" name="new_password" id="new_password" placeholder="New Password" autocomplete="off">
<br>
<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." value="Change Password">
<br>
<input class="btn btn-lg btn-primary btn-block" type=button onClick="parent.location='index.php'" value='Go back'>

</form>
</div>
</html>