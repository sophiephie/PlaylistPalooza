<?php 
session_start();
include "includes/header.php";

// connect to database
include "includes/dbConnect.php";

$successMessages = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $errorMessages = "";

  // Handle password update
  if (isset($_POST['updatePassword'])) {
      $newPassword = $_POST['password'];
      $passwordAgain = $_POST['passwordAgain'];

      // Check if the password and passwordAgain match
      if ($newPassword == $passwordAgain) {
        
        // Assuming $newPassword contains the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Get the user's ID from the session
        $userId = $_SESSION['user_id'];

        $sql = "UPDATE users SET password = :password WHERE userId = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        $successMessages = "Password successfully updated!";
      }else{
        // password and passwordAgain don't match, handle the error as needed
        $errorMessages = "Password do not match.";
      }  
  }

  // Handle name update
  if (isset($_POST['updateName'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    // Validate that both first name and last name are not empty
    if (empty($firstName) || empty($lastName)) {
      $errorMessages = "Please enter your first name and last name.";
    } else {
    
    // Get the user's ID from the session
    $userId = $_SESSION['user_id'];

    $sql = "UPDATE users SET firstName = :firstName, lastName = :lastName WHERE userId = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();

    $successMessages = "Name successfully updated!";
   }
  }

  // Handle phone number update
  if (isset($_POST['updatePhoneNumber'])) {
      $phoneNumber = $_POST['phoneNumber'];

      // Validate that phone number is not empty
      if (empty($phoneNumber)) {
        $errorMessages = "Please enter your phone number.";
      } else {

      // Get the user's ID from the session
      $userId = $_SESSION['user_id'];
      
      $sql = "UPDATE users SET phoneNumber = :phoneNumber WHERE userId = :id";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':phoneNumber', $phoneNumber);
      $stmt->bindParam(':id', $userId);
      $stmt->execute();

      $successMessages = "Phone number successfully updated!";
   }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Profile</title>
    <link rel="stylesheet" href="css/signup.css" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
  </head>
  <body>

    <!-- update profile form-->

    <div class="wrapper">
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Update Profile</h2>

        <!-- display the success message if there's any -->
        <?php if(!empty($successMessages)){ ?>
          <div class="alert alert-success">
            <?php echo $successMessages; ?>
          </div>
        <?php } ?>
        <br/>

        <!-- display the error message if there's any -->
        <?php if(!empty($errorMessages)){ ?>
          <div class="alert alert-danger">
            <?php echo $errorMessages; ?>
          </div>
        <?php } ?>
        <br/>

        <!-- password -->
        <div class="form-outline mb-4">
          <input
            type="password"
            id="password"
            name="password"
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
          <label class="form-label" for="passwordAgain">Repeat Password</label>
        </div>

        <!-- submit button-->
        <button class="btn btn-primary" type="submit" name="updatePassword">Update Password</button>
        <br />
        <br />
        <br />

        <!-- Name -->
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

        <!-- submit button-->
        <button class="btn btn-primary" type="submit" name="updateName">Update Name</button>
        <br />
        <br />
        <br />

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
        <button class="btn btn-primary" type="submit" name="updatePhoneNumber">
          Update Phone Number
        </button>
        <br />
        <br />
        <br />

        <!-- link to homepage -->
        <div class="homepage">
          <p><a href="index.php">Go Back to Homepage</a></p>
        </div>
      </form>
    </div>

    <!-- footer-->

    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
      integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

<?php include "includes/footer.html"; ?>