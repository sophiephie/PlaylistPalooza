<?php
include "includes/header.html";
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/checkout.css" />
    <title>Playlist Palooza Checkout</title>
</head>

<body>
    <div id="checkout-container">
        <?php
        // Sample event and ticket data
        $event = [
            'name' => 'Music Festival 2023',
            'date' => '2023-12-01',
            'ticket_price' => 25.00,
        ];

        // Process the form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve user input
            $selectedTickets = (int) $_POST['tickets'];

            // Calculate the total price
            $totalPrice = $selectedTickets * $event['ticket_price'];

            // Display the confirmation
            echo "<h1>Checkout Confirmation</h1>";
            echo "<p>Event: {$event['name']}</p>";
            echo "<p>Date: {$event['date']}</p>";
            echo "<p>Number of Tickets: $selectedTickets</p>";
            echo "<p>Total Price: $totalPrice</p>";
            echo "<p>Thank you for your purchase!</p>";
        } else {
            // Display the checkout form
            echo "<h1>Checkout</h1>";
            echo "<p>Event: {$event['name']}</p>";
            echo "<p>Date: {$event['date']}</p>";
            echo "<p>Ticket Price: {$event['ticket_price']}</p>";
            echo "<form method='post'>";
            echo "<label for='tickets'>Number of Tickets:</label>";
            echo "<input type='number' id='tickets' name='tickets' min='1' required>";
            echo "<br>";
            echo "<input type='submit' value='Confirm Purchase'>";
            echo "</form>";
        }

        ?>
    </div>

    <?php
    include "includes/footer.html";
    ?>

</body>

</html>