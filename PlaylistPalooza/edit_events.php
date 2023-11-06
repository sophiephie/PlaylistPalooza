<?php
session_start();
include "includes/adminHeader.php";
include "includes/dbConnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle form submission to update event data
  $eventId = $_POST['eventId'];
  $mainArtistId = $_POST['mainArtistId'];
  $location_Id = $_POST['location_Id'];
  $musicalGenre = $_POST['musicalGenre'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $price = $_POST['price'];

  // Update event data in the database
  $sql = "UPDATE events SET mainArtistId = :mainArtistId, location_Id = :location_Id, musicalGenre = :musicalGenre, date = :date, time = :time, price = :price WHERE eventId = :eventId";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':eventId', $eventId);
  $stmt->bindParam(':mainArtistId', $mainArtistId);
  $stmt->bindParam(':location_Id', $location_Id);
  $stmt->bindParam(':musicalGenre', $musicalGenre);
  $stmt->bindParam(':date', $date);
  $stmt->bindParam(':time', $time);
  $stmt->bindParam(':price', $price);
  $stmt->execute();

  // Redirect back to the events management page
  header("Location: eventsPanel.php");
  exit;
}

// Fetch event data by ID and display an edit form
if (isset($_GET['id'])) {
  $eventId = $_GET['id'];
  $sql = "SELECT eventId, mainArtistId, location_Id, musicalGenre, date, time, price FROM events WHERE eventId = :eventId";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':eventId', $eventId);
  $stmt->execute();
  $event = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Events Management Data Table</title>
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
              <h2>Events Management</h2>
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Event ID</th>
              <th>Artist ID</th>
              <th>Location ID</th>
              <th>Genre ID</th>
              <th>Date</th>
              <th>Time</th>
              <th>Price</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php if (!empty($event)) : ?>
            <tr>
              <td><?php echo $event['eventId']; ?></td>
              <td><?php echo $event['mainArtistId']; ?></td>
              <td><?php echo $event['location_Id']; ?></td>
              <td><?php echo $event['musicalGenre']; ?></td>
              <td><?php echo $event['date']; ?></td>
              <td><?php echo $event['time']; ?></td>
              <td><?php echo $event['price']; ?></td>
              <td>
                <a href="delete_events.php?id=<?php echo $event['eventId']; ?>" class="delete" title="Delete" data-toggle="tooltip">
                  <i class="material-icons">&#xE5C9;</i>
                </a>
              </td>
            </tr>
            <tr class="edit-form">
              <form action="edit_events.php" method="post">
                <td><input type="hidden" name="eventId" value="<?php echo $event['eventId']; ?>"></td>
                <td><input type="text" name="mainArtistId" value="<?php echo $event['mainArtistId']; ?>"></td>
                <td><input type="text" name="location_Id" value="<?php echo $event['location_Id']; ?>"></td>
                <td><input type="text" name="musicalGenre" value="<?php echo $event['musicalGenre']; ?>"></td>
                <td><input type="text" name="date" value="<?php echo $event['date']; ?>"></td>
                <td><input type="text" name="time" value="<?php echo $event['time']; ?>"></td>
                <td><input type="text" name="price" value="<?php echo $event['price']; ?>"></td>
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