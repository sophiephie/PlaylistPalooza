<?php
session_start();
include "includes/header.php";

// connect to database
include "includes/dbConnect.php";

$errorMessages = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $email = $_POST['email'];
  $password = $_POST['password'];

  // Check if both email and password are provided
  if (empty($email) || empty($password)) {
    $errorMessages = "All fields are required";
  } else {
    // Query the database only if both fields are provided
    $sql = "SELECT * FROM users WHERE email = :email";
    $query = $db->prepare($sql);
    $query->execute(['email' => $email]);
    $data = $query->fetch();

    if ($data) { // email exists in the database

      if (password_verify($password, $data['password'])) { // The email and password match

        $_SESSION['loggedIn'] = true;

        // Store the user info in the session
        $_SESSION['user_id'] = $data['userId'];
        $_SESSION['name'] = $data['firstName'];

        // Redirect after successful login
        if ($data['adminStatus'] == 0) {
          header('location: index.php');
        } elseif ($data['adminStatus'] == 1) {
          header('location: admin.php');
        }
        die();
      } else { // Password does not match
        $errorMessages = "Invalid email or password.";
      }
    } else { // email does not exist in the database
      $errorMessages = "Invalid email or password.";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <link rel="stylesheet" href="css/login.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
</head>

<body>
  <!-- login form-->
  <div class="wrapper">
    <form class="form-signin" action="login.php" method="post">
      <h2 class="form-signin-heading">User Login</h2>

      <!-- display the error message if there's any -->
      <?php if (!empty($errorMessages)) { ?>
        <div class="alert alert-danger">
          <?php echo $errorMessages; ?>
        </div>
      <?php } ?>

      <!-- email input -->
      <input type="text" class="form-control" name="email" placeholder="Email Address" id="email" autofocus="" />

      <!-- password input -->
      <input type="password" class="form-control" name="password" placeholder="Password" id="password" />

      <!-- submit button-->
      <div class="d-grid gap-2">
        <button class="btn btn-lg btn-primary" type="submit">Login</button>
      </div>

      <!-- link to sign up page -->
      <div class="signup">
        <br />
        <p>Not a member? <a href="signup.php">Sign Up</a></p>
      </div>
    </form>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>
</body>

</html>

<?php include "includes/footer.html"; ?>