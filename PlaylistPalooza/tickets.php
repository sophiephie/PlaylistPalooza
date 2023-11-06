<?php
session_start();
// Include the database connection
require 'includes/dbConnect.php';

// Get the user's ID from the session
$userId = $_SESSION['user_id'];



// Query to retrieve the user's ticket purchase history by joining location & artist tables to get also the ArtistName and the LocationName
$sql = "SELECT o.orderId, e.eventId, e.mainArtistId, e.date, o.orderDate, e.location_Id, o.ticketQuantity, o.totalAmount, a.artistName, l.locationName
        FROM orders as o
        JOIN events as e ON o.eventId = e.eventId
        JOIN locations as l on e.location_id = l.locationId
        JOIN artist as a on e.mainArtistId = a.artistId
        WHERE o.userId = :userId
        ORDER BY o.orderDate DESC";

$stmt = $db->prepare($sql);
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$stmt->execute();

// Fetch the purchase history data
$purchaseHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Include the header
include 'includes/header.php';
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/tickets.css" />
  <title>Ticket Purchase History</title>
</head>

<body>
  <div class="container">
    <h2>Your Ticket Purchase History</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Confirmation Number</th>
          <th>Main Artist</th>
          <th>Event Date</th>
          <th>Order Date</th>
          <th>Location</th>
          <th>Number of tickets</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($purchaseHistory as $purchase): ?>
          <tr>
            <td>
              <?= $purchase['orderId'] ?>
            </td>
            <td>
              <?= $purchase['artistName'] ?>
            </td>
            <td>
              <?= $purchase['date'] ?>
            </td>
            <td>
              <?= $purchase['orderDate'] ?>
            </td>
            <td>
              <?= $purchase['locationName'] ?>
            </td>
            <td>
              <?= $purchase['ticketQuantity'] ?>
            </td>
            <td>$
              <?= $purchase['totalAmount'] ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Include the Footer -->
  <?php include 'includes/footer.html'; ?>

</body>

</html>