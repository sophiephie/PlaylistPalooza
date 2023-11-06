<?php
session_start();
require 'includes/dbConnect.php';

// Retrieve event, quantity, total and orderId from the URL
$eventID = $_GET['event'];
$ticketQuantity = $_GET['quantity'];
$totalPrice = $_GET['total'];
$orderId = $_GET['orderId'];

// Query to fetch event details
$eventQuery = "SELECT e.eventId, e.mainArtistId, mart.artistName as mainName, e.openerArtistId, oart.artistName as openName,
    e.location_Id, l.locationName, e.date, e.time, e.price, mart.imageLink
    FROM events AS e 
    LEFT JOIN artist AS mart ON mart.artistId = e.mainArtistId 
    LEFT JOIN artist AS oart ON oart.artistId = e.openerArtistId
    JOIN locations as l on l.locationId = e.location_Id
    WHERE e.eventId = :eventId";

$query = $db->prepare($eventQuery);
$query->execute(['eventId' => $eventID]);
$eventDetails = $query->fetch();

// Check if the event and user are valid and have matching records in the database
if ($eventDetails) {
  // Include the header
  include 'includes/header.php';
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/confirmation.css" />
    <title>Confirmation | Playlist Palooza</title>
  </head>

  <body>
    <div class="container">
      <h1 class="mt-4">Purchase Confirmation</h1>

      <div class="card mb-4">
        <div class="card-body">
          <h4 class="card-title">Thank you for your purchase!</h4>

          <!-- Display purchased event details -->
          <p class="card-text">You have successfully purchased tickets for the following event:</p>
          <ul>
            <li><strong>Main Artist:</strong>
              <?= $eventDetails['mainName'] ?>
            </li>
            <li><strong>Opening Act:</strong>
              <?= $eventDetails['openName'] ?>
            </li>
            <li><strong>Location:</strong>
              <?= $eventDetails['locationName'] ?>
            </li>
            <li><strong>Date and Time:</strong>
              <?= date('F j, Y', strtotime($eventDetails['date'])) ?> at
              <?= $eventDetails['time'] ?>
            </li>
            <li><strong>Quantity:</strong>
              <?= $ticketQuantity ?>
            </li>
            <li><strong>Total Price:</strong> $
              <?= $totalPrice ?>
            </li>
            <li><strong> Confirmation number: </strong>
              <?= $orderId ?>

          </ul>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
  </body>

  </html>

  <?php
  // Include the footer
  include 'includes/footer.html';
} else {
  // Handle the case where the event details are not found
  echo "There was an issue displaying the purchase details. Please contact support.";
}
?>