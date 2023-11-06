<?php
session_start();
include "includes/adminHeader.php";
include "includes/dbConnect.php";

try {
  // Set the PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT * FROM users";
  $stmt = $db->prepare($sql);
  $stmt->execute();

  // Fetch all rows as an associative array
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
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
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
</head>

<body>
  <div class="container-xl">
    <div class="table-responsive">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="row">
            <h2>Users Management</h2>
          </div>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>User ID</th>
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
              <?php foreach ($users as $user) : ?>
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
                <a href="edit_users.php?id=<?php echo $user['userId']; ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i>
                </a>
                <a href="delete_users.php?id=<?php echo $user['userId']; ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>

<?php include "includes/footer.html"; ?>