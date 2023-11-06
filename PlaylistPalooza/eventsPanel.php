<?php
session_start();
include "includes/adminHeader.php";
include "includes/dbConnect.php";

try {
  // Set the PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT e.eventId, a.artistName, l.locationName, g.genreName, e.date, e.time, e.price FROM events e
          INNER JOIN artist a ON e.mainArtistId = a.artistId
          INNER JOIN locations l ON e.location_Id = l.locationId
          INNER JOIN genres g ON e.musicalGenre = g.genreId";
  $stmt = $db->prepare($sql);
  $stmt->execute();

  // Fetch all rows as an associative array
  $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
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
            <h2>Events Management</h2>
          </div>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Event ID</th>
              <th>Artist Name</th>
              <th>Location Name</th>
              <th>Genre Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Price</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php foreach ($events as $event) : ?>
            <tr>
              <td><?php echo $event['eventId']; ?></td>
              <td><?php echo $event['artistName']; ?></td>
              <td><?php echo $event['locationName']; ?></td>
              <td><?php echo $event['genreName']; ?></td>
              <td><?php echo $event['date']; ?></td>
              <td><?php echo $event['time']; ?></td>
              <td><?php echo $event['price']; ?></td>
              <td>
                <a href="edit_events.php?id=<?php echo $event['eventId']; ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i>
                </a>
                <a href="delete_events.php?id=<?php echo $event['eventId']; ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <br />
        <a href="create_event.php" class="btn btn-primary ml-auto">Create New Event</a>
      </div>
    </div>
  </div>
</body>

</html>

<?php include "includes/footer.html"; ?>