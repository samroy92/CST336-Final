<?php
    require "./db_connection.php";

//establishes database connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

//shows errors when connecting to database
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


    $sql = "CREATE TABLE auto_login (
    username varchar (50),
    date varchar (50),
    time varchar (50) NOT NULL
    )";

    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute();

    echo "Your login table has been created";
?>