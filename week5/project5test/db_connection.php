<?php


$host     = "localhost";
$dbname   = "goss4649"; //change this to your otterID
$username = "goss4649"; //change this to your otter ID
$password = "047f0465cb80dd3"; //change this to your database account password

//establishes database connection
try
{	
	$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	}
	catch(Exception $e)
	{
		echo "unable to connect to database -Keith";
		exit();	
	}
	//shows errors when connecting to database
	$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


?>