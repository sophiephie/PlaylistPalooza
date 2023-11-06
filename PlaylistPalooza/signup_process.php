<?php
session_start();
include "includes/header.php";
include "includes/dbConnect.php";

// check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordAgain = $_POST['passwordAgain'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $phoneNumber = $_POST['phoneNumber'];

  $errorMessages = "";

  // validate the data
  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
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

  if (empty($firstName) || empty($lastName) || empty($phoneNumber)) {
    $errorMessages .= "All fields are required. <br/>";
  }

  if (empty($errorMessages)) {

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database

    $accountStatus = 1; // Set a default value
    $adminStatus = 0; // // Set a default value

    $sql = "INSERT INTO users (email, password, firstName, lastName, phoneNumber, accountStatus, adminStatus) VALUES (:email, :password, :firstName, :lastName, :phoneNumber, :accountStatus, :adminStatus)";
    $stmt = $db->prepare($sql);

    if ($stmt->execute([
      ":email" => $email,
      ":password" => $hashedPassword,
      ":firstName" => $firstName,
      ":lastName" => $lastName,
      ":phoneNumber" => $phoneNumber,
      ":accountStatus" => $accountStatus,
      ":adminStatus" => $adminStatus
    ])) {
      // User registration successful
      // get the user_id of the newly registered user
      $user_id = $db->lastInsertId();

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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
</head>

<body>

  <!-- sign up form-->

  <div class="wrapper">
    <form class="form-signin">

      <!-- display the error message if there's any -->
      <?php if (!empty($errorMessages)) { ?>
        <div class="alert alert-danger">
          <?php echo $errorMessages; ?>
          <!-- link to sign up page -->
        </div>
        <p><a href="signup.php">Go Back to Sign Up</a></p>
      <?php } ?>
    </form>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>

<?php include "includes/footer.html"; ?>