<?php
session_start();
include "includes/adminHeader.php";
include "includes/dbConnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle form submission to update user data
  $userId = $_POST['userId'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $phoneNumber = $_POST['phoneNumber'];
  $accountStatus = $_POST['accountStatus'];
  $adminStatus = $_POST['adminStatus'];

  // Update user data in the database
  $sql = "UPDATE users SET firstName = :firstName, lastName = :lastName, phoneNumber = :phoneNumber, accountStatus = :accountStatus, adminStatus = :adminStatus WHERE userId = :userId";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':userId', $userId);
  $stmt->bindParam(':firstName', $firstName);
  $stmt->bindParam(':lastName', $lastName);
  $stmt->bindParam(':phoneNumber', $phoneNumber);
  $stmt->bindParam(':accountStatus', $accountStatus);
  $stmt->bindParam(':adminStatus', $adminStatus);
  $stmt->execute();

  // Redirect back to the user management page
  header("Location: usersPanel.php");
  exit;
}

// Fetch user data by ID and display an edit form
if (isset($_GET['id'])) {
  $userId = $_GET['id'];
  $sql = "SELECT * FROM users WHERE userId = :userId";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':userId', $userId);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Users Management Data Table</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/adminPanel.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();

      $('.edit').click(function() {
        $(this).closest('tr').next('.edit-form').toggle();
      });
    });
  </script>
</head>

<body>
  <div class="container-xl">
    <div class="table-responsive">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="row">
            <div class="col-sm-5">
              <h2>Users Management</h2>
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>User Id</th>
              <th>Email</th>
              <th>Password</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Phone Number</th>
              <th>Account Status</th>
              <th>Admin Status</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php if (!empty($user)) : ?>
            <tr>
              <td><?php echo $user['userId']; ?></td>
              <td><?php echo $user['email']; ?></td>
              <td><?php echo $user['password']; ?></td>
              <td><?php echo $user['firstName']; ?></td>
              <td><?php echo $user['lastName']; ?></td>
              <td><?php echo $user['phoneNumber']; ?></td>
              <td><?php echo $user['accountStatus']; ?></td>
              <td><?php echo $user['adminStatus']; ?></td>
              <td>
                <a href="delete_users.php?id=<?php echo $user['userId']; ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i>
                </a>
              </td>
            </tr>
            <tr class="edit-form">
              <form action="edit_users.php" method="post">
                <td><input type="hidden" name="userId" value="<?php echo $user['userId']; ?>"></td>
                <td><input type="text" name="email" value="<?php echo $user['email']; ?>"></td>
                <td><input type="text" name="password" value="<?php echo $user['password']; ?>"></td>
                <td><input type="text" name="firstName" value="<?php echo $user['firstName']; ?>"></td>
                <td><input type="text" name="lastName" value="<?php echo $user['lastName']; ?>"></td>
                <td><input type="text" name="phoneNumber" value="<?php echo $user['phoneNumber']; ?>"></td>
                <td><input type="text" name="accountStatus" value="<?php echo $user['accountStatus']; ?>"></td>
                <td><input type="text" name="adminStatus" value="<?php echo $user['adminStatus']; ?>"></td>
                <td>
                  <button type="submit">Save</button>
                </td>
              </form>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>

<?php include "includes/footer.html"; ?>