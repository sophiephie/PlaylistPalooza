<?php
session_start();
include "includes/adminHeader.php";
include "includes/dbConnect.php";

// Get the list of artists and locations
$artists = getArtists();
$locations = getLocations();
$genres = getGenres();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle form submission to create a new event
  $artistId = $_POST['artistId'];
  $locationId = $_POST['locationId'];
  $genreId = $_POST['genreId'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $price = $_POST['price'];

  // Insert the new event into the database
  $sql = "INSERT INTO events (mainArtistId, location_Id, musicalGenre, date, time, price) VALUES (
    :mainArtistId, :location_Id, :musicalGenre, :date, :time, :price
  )";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':mainArtistId', $artistId);
  $stmt->bindParam(':location_Id', $locationId);
  $stmt->bindParam(':musicalGenre', $genreId);
  $stmt->bindParam(':date', $date);
  $stmt->bindParam(':time', $time);
  $stmt->bindParam(':price', $price);
  $stmt->execute();

  // Redirect back to the events management page
  header("Location: eventsPanel.php");
  exit;
}

// Function to get a list of artists from the database
function getArtists()
{
  global $db;
  $sql = "SELECT artistId, artistName FROM artist";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get a list of locations from the database
function getLocations()
{
  global $db;
  $sql = "SELECT locationId, locationName FROM locations";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get a list of genres from the database
function getGenres()
{
  global $db;
  $sql = "SELECT genreId, genreName FROM genres";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Event Page</title>
  <link rel="stylesheet" href="css/create_event.css" />
</head>

<body>
  <div class="container2">
    <h2>Create New Event</h2>
    <br />
    <div class="wrapper">
      <form action="create_event.php" method="post">
        <div class="mb-3">
          <label for="artistId" class="form-label">Artist Name:</label>
          <select class="form-select" name="artistId" id="artistId" required>
            <option value="" disabled selected>Select an artist</option>
            <?php foreach ($artists as $artist) : ?>
              <option value="<?php echo $artist['artistId']; ?>"><?php echo $artist['artistName']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="locationId" class="form-label">Location Name:</label>
          <select class="form-select" name="locationId" id="locationId" required>
            <option value="" disabled selected>Select a location</option>
            <?php foreach ($locations as $location) : ?>
              <option value="<?php echo $location['locationId']; ?>"><?php echo $location['locationName']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="genreId" class="form-label">Genre Name:</label>
          <select class="form-select" name="genreId" id="genreId" required>
            <option value="" disabled selected>Select a genre</option>
            <?php foreach ($genres as $genre) : ?>
              <option value="<?php echo $genre['genreId']; ?>"><?php echo $genre['genreName']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="date" class="form-label">Date:</label>
          <input type="date" class="form-control" name="date" id="date" required />
        </div>
        <div class="mb-3">
          <label for="time" class="form-label">Time:</label>
          <input type="time" class="form-control" name="time" id="time" required />
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price:</label>
          <input type="text" class="form-control" name="price" id="price" required />
        </div>
        <button type="submit" class="btn btn-primary">Create Event</button>
      </form>
    </div>
  </div>
</body>

</html>