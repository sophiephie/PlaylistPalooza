<?php

// connect to database
include "includes/dbConnect.php";

// check if the form was submitted
if($_SERVER['REQUEST_METHOD'] == "POST"){

  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordAgain = $_POST['passwordAgain'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $phoneNumber = $_POST['phoneNumber'];

  $errorMessages = "";

  // validate the data
  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errorMessages .= "Please enter a valid email address. <br/>";
  }

  if (empty($password)) {
    $errorMessages .= "Please enter a password. <br/>";
  }

  if (empty($passwordAgain)) {
    $errorMessages .= "Please enter a password again. <br/>";
  }

  if ($password != $passwordAgain) {
    $errorMessages .= "Password do not match. <br/>";
  }

  if (empty($firstName) || empty($lastName) || empty($phoneNumber) ) {
    $errorMessages .= "All fields are required. <br/>";
  }

  if(empty($errorMessages)){

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database

    $sql = "INSERT INTO users (email, password, firstName, lastName, phoneNumber) VALUES (:email, :password, :firstName, :lastName, :phoneNumber)";
    $stmt = $db->prepare($sql);

    if ($stmt->execute([$email, $hashedPassword, $firstName, $lastName, $phoneNumber])) {
        // User registration successful
        // redirect the user to a success page
        header("Location: index.php");
        exit();
    } else {
        // Handle database error
        $errorMessages .= "Error registering the user. Please try again.";
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup Page</title>
    <link rel="stylesheet" href="css/signup.css" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
  </head>
  <body>

    <!-- sign up form-->

    <div class="wrapper">
      <form class="form-signin" action="signup.php" method="POST">
        <h2 class="form-signin-heading">Sign Up</h2>

        <!-- email -->
        <div class="form-outline mb-4">
          <input type="text" id="email" name = "email" class="form-control form-control-lg" />
          <label class="form-label" for="email">Email</label>
        </div>

        <!-- password -->
        <div class="form-outline mb-4">
          <input
            type="text"
            id="password"
            name = "email"
            class="form-control form-control-lg"
          />
          <label class="form-label" for="password">Password</label>
        </div>

        <!-- password again -->
        <div class="form-outline mb-4">
          <input
            type="text"
            id="passwordAgain"
            name="passwordAgain"
            class="form-control form-control-lg"
          />
          <label class="form-label" for="passwordAgian">Repeat Password</label>
        </div>

        <!-- name -->
        <div class="row">
          <div class="col-md-6 mb-4">
            <div class="form-outline">
              <input
                type="text"
                id="firstName"
                name="firstName"
                class="form-control form-control-lg"
              />
              <label class="form-label" for="firstName">First Name</label>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-outline">
              <input
                type="text"
                id="lastName"
                name="lastName"
                class="form-control form-control-lg"
              />
              <label class="form-label" for="lastName">Last Name</label>
            </div>
          </div>
        </div>

        <!-- phone number -->
        <div class="form-outline mb-4">
          <input
            type="text"
            id="phoneNumber"
            name="phoneNumber"
            class="form-control form-control-lg"
          />
          <label class="form-label" for="phoneNumber">Phone Number</label>
        </div>

        <!-- submit button-->
        <br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">
          Sign Up
        </button>

        <!-- link to login page -->
        <div class="login">
          <br />
          <p>Have already an account? <a href="login.php">Login Here</a></p>
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