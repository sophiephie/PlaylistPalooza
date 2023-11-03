<?php
// Get the user's ID from the session
$userId = $_SESSION['userId'];

// Include the database connection
require 'includes/dbConnect.php';

// Query to retrieve the user's ticket purchase history
$sql = "SELECT o.orderId, e.eventId, e.mainArtistId, e.date, e.location_Id, e.price
        FROM orders o
        JOIN events e ON o.eventId = e.eventId
        WHERE o.userId = :userId";

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
  <!-- Add your head content here -->
  <title>Ticket Purchase History</title>
</head>

<body>
  <div class="container">
    <h2>Your Ticket Purchase History</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Event ID</th>
          <th>Main Artist</th>
          <th>Date</th>
          <th>Location</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($purchaseHistory as $purchase): ?>
          <tr>
            <td>
              <?= $purchase['orderId'] ?>
            </td>
            <td>
              <?= $purchase['eventId'] ?>
            </td>
            <!-- You can fetch the main artist name from the artist table -->
            <td>
              <?= getMainArtistName($purchase['mainArtistId']) ?>
            </td>
            <td>
              <?= $purchase['date'] ?>
            </td>
            <!-- You can fetch the location name from the locations table -->
            <td>
              <?= getLocationName($purchase['location_Id']) ?>
            </td>
            <td>$
              <?= $purchase['price'] ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php include 'includes/footer.html'; ?>

  <!-- Add your JavaScript or other scripts here if needed -->
</body>

</html>