<?php

session_start();

// connect to database
include "includes/dbConnect.php";

$errorMessages = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check if both username and password are provided
  if(empty($username) || empty($password)){
    $errorMessages = "All fields are required";
  } else{
    // Query the database only if both fields are provided
    $sql = "SELECT * FROM users WHERE username = :username";
    $query = $db->prepare($sql);
    $query->execute(['username' => $username]);
    $data = $query->fetch();

    if ($data) { // Username exists in the database

      // if (password_verify($password, $data['password']))
      if ($password == $data['password']){ // The username and password match

        // Redirect after successful login
        header('location: ../index.php');
        die();
      } else { // Password does not match
        $errorMessages = "Invalid username or password.";
      }
    } else { // Username does not exist in the database
      $errorMessages = "Invalid username or password.";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/style_login.css" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <!-- login form-->
    <div class="wrapper">
      <form class="form-signin" action="login.php" method="post">
        <h2 class="form-signin-heading">User Login</h2>

        <!-- display the error message if there's any -->
        <?php if(!empty($errorMessages)){ ?>
          <div class="alert alert-danger">
            <?php echo $errorMessages; ?></div>
        <?php } ?>
        
        <!-- email input -->
        <input
          type="text"
          class="form-control"
          name="username"
          placeholder="Email Address"
          id="username"
          autofocus=""
        />

        <!-- password input -->
        <input
          type="password"
          class="form-control"
          name="password"
          placeholder="Password"
          id="password"
        />

        <!-- submit button-->
        <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
          Login
        </button>

        <!-- sign up -->
        <div class="signup">
          <br />
          <p>Not a member? <a href="signup.html">Sign Up</a></p>
        </div>
      </form>
    </div>

    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
      integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"
    ></script>
  </body>
</html>