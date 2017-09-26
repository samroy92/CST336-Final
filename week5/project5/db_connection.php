<?php


$host     = "localhost";
$dbname   = "roy1868"; //change this to your otterID
$username = "roy1868"; //change this to your otter ID
$password = "JeepersCreepers"; //change this to your database account password

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