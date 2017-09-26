<?php

session_start();

if (isset($_POST['username'])){
require './db_connection.php';

$sql = "SELECT *
FROM auto_admin
WHERE username = :username
AND password = :password";

$stmt = $dbConn -> prepare($sql);
$stmt -> execute(array(":username" => $_POST['username'], ":password" => hash("sha1", $_POST['password'])));

$record = $stmt -> fetch();

if (empty($record)){
echo "Wrong username/password!";
} else {
$_SESSION['username'] = $record['username'];
$_SESSION['name'] = $record['firstname'] . " " . $record['lastname'];
header("Location: password.php");
}
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
  </head>

  <body>
    <div class="container">

<form  class="form-signin" method="post">
	<h2 class="form-signin-heading">Please sign in</h2>
<label for="inputUsername" class="sr-only">Username:</label>
 <input type="text" class="form-control" name="username"  /><br />
<label for="inputPassword" class="sr-only">Password:</label>
 <input type="password" class="form-control" name="password" /><br />
<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
<p></p>
</form>
<p>
Username: grov1336<br />
Password: 1234
</p>
</div>
</body>
</html>