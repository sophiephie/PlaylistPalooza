<?php

// session_start(); // allows the use of $_SESSION

// set flag to know if user if logged in
// $userIsLoggedIn = $_SESSION['loggedIn'] ?? false;

// variable
$dbType = "mysql";
$dbServer = "localhost";
$dbName = "fsd10_Whisky";
$dbPort = "3307";
$dbCharset = "utf8";
$dbUsername = "fsduser";
$dbPassword = "myDBpw";

// connection string (data source name)
$dbDSN = "{$dbType}:host={$dbServer};dbname={$dbName};port={$dbPort};charset={$dbCharset}";

// open database connection
$db = new PDO($dbDSN, $dbUsername, $dbPassword);
