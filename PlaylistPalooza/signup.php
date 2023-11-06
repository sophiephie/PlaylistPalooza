<?php 
session_start();
include "includes/header.php";
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
      href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
  </head>
  <body>

    <!-- sign up form-->

    <div class="wrapper">
      <form class="form-signin" action="signup_process.php" method="POST">
        <h2 class="form-signin-heading">Sign Up</h2>

        <!-- email -->
        <div class="form-outline mb-4">
          <input type="text" id="email" name = "email" class="form-control form-control-lg" />
          <label class="form-label" for="email">Email</label>
        </div>

        <!-- password -->
        <div class="form-outline mb-4">
          <input
            type="password"
            id="password"
            name = "password"
            class="form-control form-control-lg"
          />
          <label class="form-label" for="password">Password</label>
        </div>

        <!-- password again -->
        <div class="form-outline mb-4">
          <input
            type="password"
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
        <div class="d-grid gap-2">
          <button class="btn btn-lg btn-primary" type="submit">Sign Up</button>
        </div>

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

<?php include "includes/footer.html"; ?>