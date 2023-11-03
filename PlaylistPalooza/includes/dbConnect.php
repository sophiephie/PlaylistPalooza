<?php

// session_start(); // allows the use of $_SESSION

// set flag to know if user if logged in

$userIsLoggedIn = $_SESSION['loggedIn'] ?? false;


// require "includes/functions.php";

// variables
$dbType = "mysql"; // type of db to connect to
$dbServer = "localhost"; // host name of my server
$dbName = "fsd10_Whisky"; // name of my db
$dbPort = "3307"; // port for db server
$dbCharset = "utf8"; // charset encoding for db
$dbUsername = "fsduser"; // user with access to db
$dbPassword = "myDBpw"; // $dbUsername password

// connection string (data source name)
$dbDSN = "{$dbType}:host={$dbServer};dbname={$dbName};port={$dbPort};
charset={$dbCharset}";

// open database connection
$db = new PDO($dbDSN, $dbUsername, $dbPassword);


// contains all the categories
$sql = "SELECT eventId FROM events ORDER BY eventId ASC";
$query = $db->query($sql);
$allCategories = $query->fetchAll();
