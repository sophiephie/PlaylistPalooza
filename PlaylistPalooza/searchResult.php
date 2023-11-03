<?php
require 'includes/dbConnect.php';

$searchErr = '';
$searchTerm = '';

if (isset($_GET['search'])) {
  $searchTerm = $_GET['search'];
  if (!empty($searchTerm)) {
    $sql = "SELECT a.artistName, a.imageLink, e.eventId, e.date, l.locationName
            FROM artist a
            JOIN events e ON a.artistId = e.mainArtistId
            JOIN locations l ON e.location_Id = l.locationId
            WHERE artistName LIKE :search";
    $stmt = $db->prepare($sql);
    $searchParam = '%' . $searchTerm . '%';
    $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
    $stmt->execute();
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $searchErr = "Please enter the artist name";
  }
}

include "includes/header.php";
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/searchResult.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <title>Playlist Palooza Search Results</title>
</head>

<body>
  <div class="container">
    <h2>Search Events for:
      <?php echo $searchTerm; ?>
    </h2>

    <div class="row">
      <?php if (!empty($searchResults)): ?>
        <?php foreach ($searchResults as $result): ?>
          <div class="col-md-4 mb-4">
            <div class="card eventCard">
              <img src="<?php echo $result['imageLink']; ?>" class="card-img-top"
                alt="<?php echo $result['artistName']; ?>">
              <div class="card-body">
                <h5 class="card-title">
                  <?php echo $result['artistName']; ?>
                </h5>
                <p class="card-text">Event Date:
                  <?php echo $result['date']; ?>
                </p>
                <p class="card-text">Event Location:
                  <?php echo $result['locationName']; ?>
                </p>
                <a href="eventPage.php?eventId=<?php echo $result['eventId']; ?>" class="btn btn-primary">View Event</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col">
          <p>No results found for "
            <?php echo $searchTerm; ?>"
          </p>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php include "includes/footer.html"; ?>
</body>

</html>