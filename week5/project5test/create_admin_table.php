<?php
    require "./db_connection.php";
	
	$sql = "CREATE TABLE auto_admin (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	firstname varchar (50),
	lastname varchar (50),
	username varchar (50) NOT NULL,
	password varchar (50) NOT NULL)";
	
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute();
	
	$sql = "INSERT INTO auto_admin (firstname, lastname, username, password)
			VALUES
			(:firstname, :lastname, :username, :password)";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute (array (":firstname" => "Keith", ":lastname" => "Groves", "username" => "grov1336", ":password" => hash("sha1","1234")));
	
	echo "Your admin table has been created";
?>