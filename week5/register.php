 <?php
 
 if (isset($_POST['username']))
{
	echo "submitted!!!";
	require './db_connection.php';
	$sql = "INSERT INTO auto_admin VALUES('',:firstname,:lastname,:username,:password)";
	
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":firstname" => $_POST['firstname'], ":lastname" => $_POST['lastname'], ":username" => $_POST['username'], ":password" => hash("sha1", $_POST['password'])));

}
 
 ?>
 
 <html>
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
 <form class="form-signin" method="post" action="register.php" name="registerform" id="registerform">
 	<h2 class="form-signin-heading">Please register an account</h2>
    <fieldset>
        <label for="username">First Name:</label><input class="form-control" type="text" name="firstname" id="firstname" /><br />
        <label for="password">Last Name:</label><input class="form-control" type="text" name="lastname" id="lastname" /><br />
        <label for="username">Username:</label><input class="form-control" type="text" name="username" id="username" /><br />
        <label for="password">Password:</label><input class="form-control" type="password" name="password" id="password" /><br />
        <input class="btn btn-lg btn-primary btn-block" type="submit" name="register" id="register" value="Register" />
       	<input class="btn btn-lg btn-primary btn-block" type=button onClick="parent.location='login.php'" value='Go back'>
 </fieldset>
 </div>
 </body>
</html>  