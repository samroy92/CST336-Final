<?php

require "db_connection.php";


$sql = "CREATE TABLE nfl_admin (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
firstname varchar (50),
lastname varchar (50),
username varchar (50) NOT NULL,
password varchar (50) NOT NULL)";

$stmt = $dbConn -> prepare($sql);
$stmt -> execute();

$sql = "INSERT INTO nfl_admin
(firstname, lastname, username, password)
VALUES
(:firstname, :lastname, :username, :password)";
$stmt = $dbConn -> prepare($sql);
$stmt -> execute ( array (":firstname" => "Bude", ":lastname" => "Su", ":username" => "su5196", ":password" => hash('sha1', 'secret'))); //You need to change the values to your own firstname, lastname, username (your otter id), and a password that you would like to set for your admin table instead of what I set as "secret".


echo "Your admin table is created!";

?>