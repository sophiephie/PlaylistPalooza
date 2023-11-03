<?php
require "includes/dbConnect.php";

// check that GET has an item
if (!isset($_GET['item'])) {
    // the GET does NOT have a key named item
    pageNotFound();
}

// there is a $_GET['item'] that exists
$sql =
    "SELECT 
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
$query->execute(['id' => $_GET['item']]);

$result = $query->fetch(); // fetch single row from db
if (!$result) { // nothing found in the database
    pageNotFound();
}

$mainArtistName = " Main Artist Name";
$openerArtistName = "with " . "Opening Act";
$eventLocation = "Place Bell Laval";
$eventDate = "November 21, 2023";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/eventPage.css" />
    <title>
        <?= $mainArtistName . " | Playlist Palooza" ?>
    </title>
</head>

<body>
    <header>
        <?php include "includes/header.php"; ?>
    </header>

    <article style="background-color: #fff0df;" class="event container-fluid">
        <article class="row text-center">
            <img src=<?= $result['imageLink'] ?> alt="artist" class="container col-md-6 ">
            <section id="eventInfo" class="col-md-6">
                <h2>
                    <?= $result['mainName'] ?>
                </h2>
                <h5>
                    <?= "with " . $result['openName'] ?>
                </h5>
                <h4>
                    <?= $result['locationName'] ?>
                </h4>
                <h4>
                    <?= date('F j, Y', strtotime($result['date'])) . " at " . $result['time'] ?>
                </h4>
                <?php if ($result['ticketsSold'] >= $result['maxCapacity']) { ?>
                    <button type="button" class="btn btn-light">Sold
                        Out</button>
                <?php } else { ?>
                    <a href="checkout.php?event=<?= $result['eventId'] ?>"><button type="button"
                            class="btn btn-dark">Purchase Tickets</button></a>
                <?php } ?>
            </section>
        </article>

        <article class="otherEvent row container text-start">
            <section class="otherEvents row">
                <h2>You may also like</h2>
                <figure class="col">
                    <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863"
                            alt="artist name" width="100%"></a>
                    <figcaption>
                        <h4>Laval</h4>
                        <h2>Charlotte Cardin</h2>
                        <h4>Feb 8 2023</h4>
                    </figcaption>
                </figure>
                <figure class="col">
                    <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863"
                            alt="artist name" width="100%"></a>
                    <figcaption>
                        <h4>Laval</h4>
                        <h2>Charlotte Cardin</h2>
                        <h4>Feb 8 2023</h4>
                    </figcaption>
                </figure>
                <figure class="col">
                    <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863"
                            alt="artist name" width="100%"></a>
                    <figcaption>
                        <h4>Laval</h4>
                        <h2>Charlotte Cardin</h2>
                        <h4>Feb 8 2023</h4>
                    </figcaption>
                </figure>
            </section>
        </article>
    </article>

    <footer>
        <?php include "includes/footer.html"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>