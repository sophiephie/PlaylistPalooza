<?php
require 'includes/dbConnect.php';

$artistPic1 = "https://www.evenko.ca/_uploads/event/51087/featured.jpg?v=1670334813";
$artistPic2 = "https://www.evenko.ca/_uploads/event/57675/featured.jpg?v=1697740433";
$artistPic3 = "https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863";
$artistName1 = "Artist_Name_1";
$artistName2 = "Artist_Name_2";
$artistName3 = "Artist_Name_3";
$eventPage1 = "https://www.w3schools.com";
$eventPage2 = "https://www.w3schools.com";
$eventPage3 = "https://www.w3schools.com";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/index.css" />
    <title>Home | Playlist Palooza</title>
</head>

<body id="indexBody">
    <header> <?php include "includes/header.php"; ?> </header>

    <article class="slideshow">
        <article class="container">
            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="<?= $eventPage1 ?>"> <img src="<?= $artistPic1 ?>" class="d-block w-100" alt="..." /> </a>
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?= $artistName1 ?></h5>
                            <p>
                                Some representative placeholder content for the first slide.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <a href="<?= $eventPage2 ?>"> <img src="<?= $artistPic2 ?>" class="d-block w-100" alt="..." /> </a>
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?= $artistName1 ?></h5>
                            <p>
                                Some representative placeholder content for the second slide.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <a href="<?= $eventPage3 ?>"> <img src="<?= $artistPic3 ?>" class="d-block w-100" alt="..." /> </a>
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?= $artistName1 ?></h5>
                            <p>
                                Some representative placeholder content for the third slide.
                            </p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </article>
    </article>

    <article class="events container-fluid">

        <section class="eventsHeader mt-4">
            <h2>Upcoming Events</h2>
        </section>

        <section id="eventSection" class="row row-cols-3">

            <?php


            // turn this into a function that has to be called??

            $sql = "SELECT * FROM events ORDER BY date limit 0,3";

            $query = $db->prepare($sql);
            $query->execute();
            ?>

            <?php while ($row = $query->fetch()) {
                $link = "eventPage.php?item=" . $row['eventId'];

                $getMainArtist = $db->prepare("SELECT * FROM artist where artistId = :id");
                $getMainArtist->execute(['id' => $row['mainArtistId']]);
                $mainArtist = $getMainArtist->fetch();

                $getOpenArtist = $db->prepare("SELECT * FROM artist where artistId = :id");
                $getOpenArtist->execute(['id' => $row['openerArtistId']]);
                $openArtist = $getOpenArtist->fetch();

                $getLocationTable = $db->prepare("SELECT * FROM locations where locationId = :id");
                $getLocationTable->execute(['id' => $row['location_Id']]);
                $rowLoc = $getLocationTable->fetch();
            ?>
                <figure class="eventCards col">
                    <a href=<?= $link ?>> <img class="img-fluid" src="<?= $mainArtist['imageLink']; ?>" alt="picture_of_artist"></a>
                    <figcaption>
                        <h4><?= $rowLoc['locationName']; ?></h4>
                        <h2><?= $mainArtist['artistName'] ?></h2>
                        <h3> <?= "with " . $openArtist['artistName']  ?> </h3>
                        <h4><?= date('F j, Y', strtotime($row['date'])); ?></h4>
                    </figcaption>
                </figure>
            <?php }
            ?>
        </section>

        <section class="loadButton text-center">
            <button type="button" id="loadMoreBtn" class="btn btn-dark">Load More</button>
        </section>

    </article>

    <footer>
        <?php include "includes/footer.html"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="javascript/index.js"></script>
</body>

</html>