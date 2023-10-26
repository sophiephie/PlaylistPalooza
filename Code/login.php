<?php

// connect to database
require 'includes/dbConnect.php';

$errorMessages = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $username = $_POST['txtUser'];
  $password = $_POST['txtPass'];

  // Query the database
  $sql = "SELECT * FROM users WHERE username = :user";
		$query = $db->prepare($sql);
		$query->execute(['user'=> $username]);
		$data = $query->fetch();

    if ($data){
			// username exist in the database
			
			if (password_verify($password, $data['password'])){
				// The username and password match

        session_start();
        // $_SESSION['user_id'] = $data['id'];
        
        // redirect
        header('location: index.php');
        die();
			} else {
        // username does not exits in the database OR password does not match
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

        <!-- email input -->
        <input
          type="text"
          class="form-control"
          name="txtUser"
          placeholder="Email Address"
          required="required"
          autofocus=""
        />

        <!-- password input -->
        <input
          type="password"
          class="form-control"
          name="txtPass"
          placeholder="Password"
          required="required"
        />

        <!-- display the error message if there's any -->
        <?php if (!empty($errorMessages)): ?>
          <div class="alert alert-danger">
            <?php echo $errorMessages; ?>
          </div>
        <?php endif; ?>

        <!-- remember me -->
        <div class="row mb-4">
          <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="form2Example31"
                checked
              />
              <label class="form-check-label" for="form2Example31">
                Remember me
              </label>
            </div>
          </div>

          <div class="col">
            <!-- Simple link -->
            <a href="#!">Forgot password?</a>
          </div>
        </div>

        <!-- submit button-->
        <button class="btn btn-lg btn-primary btn-block" type="submit">
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