<?php

// connect to database
include "includes/dbConnect.php";

session_destroy();

// Redirect to the login page:
header('Location: index.php');

?>