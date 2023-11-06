<?php
session_start();
include "includes/dbConnect.php";

// Check if a user is authenticated (adjust this to your user authentication system)
if (!$userIsLoggedIn) {
    header("Location: login.php"); // Redirect to the login page if the user is not authenticated
    exit();
}

if (isset($_GET['event'])) {
    $eventID = $_GET['event'];

    // Fetch event details based on eventID
    $sql = "SELECT 
        e.eventId, 
        e.mainArtistId, 
        mart.artistName as mainName, 
        e.openerArtistId, 
        oart.artistName as openName,
        e.location_Id,
        l.locationName,
        e.date,
        e.time,
        e.price,
        mart.imageLink,
        SUM(o.ticketQuantity) as ticketsSold,
        l.maxCapacity as maxCapacity
    FROM events AS e 
    LEFT JOIN artist AS mart ON mart.artistId = e.mainArtistId 
    LEFT JOIN artist AS oart ON oart.artistId = e.openerArtistId
    LEFT JOIN orders AS o ON o.eventId = e.eventId
    JOIN locations as l on l.locationId = e.location_Id
    WHERE e.eventId = :id";

    $query = $db->prepare($sql);
    $query->execute(['id' => $eventID]);

    $eventDetails = $query->fetch();
    if (!$eventDetails) {
        pageNotFound();
    }

    // Calculate total price and initialize user data
    $ticketWarning = '';
    $ticketPrice = $eventDetails['price'];
    $ticketQuantity = 1;
    $totalPrice = $ticketPrice;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize user input
        $ticketQuantity = filter_var($_POST['ticket_quantity'], FILTER_SANITIZE_NUMBER_INT);
        if ($ticketQuantity > 0 && ($eventDetails['ticketsSold'] + $ticketQuantity) <= $eventDetails['maxCapacity']) {
            $totalPrice = $ticketPrice * $ticketQuantity;
            $userID = $_SESSION['user_id']; // Get the user ID from the session (user authentication required)

            // Insert purchase data into the database
            $insertQuery = "INSERT INTO orders (eventId, userId, ticketQuantity, totalAmount) VALUES (:eventId, :userId, :ticketQuantity, :totalAmount)";
            $insertStatement = $db->prepare($insertQuery);
            $insertStatement->execute([
                'eventId' => $eventID,
                'userId' => $_SESSION['user_id'],
                // Use the user ID from the session
                'ticketQuantity' => $ticketQuantity,
                'totalAmount' => $totalPrice,
            ]);

            $orderId = $db->lastInsertId('orderId');

            // Redirect to the confirmation page after successful purchase
            header("Location: confirmation.php?event=$eventID&quantity=$ticketQuantity&total=$totalPrice&orderId=$orderId");
            exit();
        } else {
            $ticketWarning = "Not enough tickets available.";
        }
    }
} else {
    pageNotFound();
}

function pageNotFound()
{
    header("HTTP/1.0 404 Not Found");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/checkout.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Checkout| Playlist Palooza</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <!-- Bootstrap card container for the checkout form -->
    <div class="container my-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Checkout</h1>
                <div class="event-details">
                    <img src="<?= $eventDetails['imageLink'] ?>" alt="Artist" class="event-image">
                    <div class="event-info">
                        <h2>
                            <?= $eventDetails['mainName'] ?>
                        </h2>
                        <h5>
                            <?= "with " . $eventDetails['openName'] ?>
                        </h5>
                        <h4>
                            <?= $eventDetails['locationName'] ?>
                        </h4>
                        <h4>
                            <?= date('F j, Y', strtotime($eventDetails['date'])) . " at " . $eventDetails['time'] ?>
                        </h4>
                    </div>
                </div>
                <div class="purchase-details">
                    <h6>Enter the number of tickets you want to purchase:</h6>
                    <p class='text-warning'>
                        <?php echo ($ticketWarning) ?>
                    </p>
                    <form method="post">
                        <div class="form-group">
                            <label for="ticket_quantity">Ticket Quantity:</label>
                            <input type="number" class="form-control" id="ticket_quantity" name="ticket_quantity"
                                value="<?= $ticketQuantity ?>" required>
                        </div>
                        <p>Total Price: $
                            <?= $totalPrice ?>
                        </p>
                        <?php if (($eventDetails['ticketsSold']) < $eventDetails['maxCapacity']) { ?>
                            <button type="submit" class="btn btn-primary">Confirm Purchase</button>
                        <?php } else { ?>
                            <button class="btn btn-light" disabled>Sold Out</button>
                        <?php } ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.html'; ?>
</body>

</html>