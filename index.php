<?php
$artistPic1 = "https://t4.ftcdn.net/jpg/05/24/83/87/360_F_524838701_3kb13tmtR4wNze5cHpfSepAXCOoXwD0d.jpg";
$artistPic2 = "https://www.shutterstock.com/image-illustration/number-two-polished-golden-object-260nw-371522539.jpg";
$artistPic3 = "https://cdn.pixabay.com/photo/2015/04/04/19/13/three-706895_1280.jpg";
$artistName1 = "Artist_Name_1";
$artistName2 = "Artist_Name_2";
$artistName3 = "Artist_Name_3";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/index.css" />
    <title>Playlist Palooza</title>
</head>

<body>
    <article class="slideshow">
        <section class="buttons">
            <button id="backButton"></button>
            <button id="forwardButton"></button>
        </section>
        <section id="slides">
            <figure>
                <img id="slide1" style="display: none" src=<?= $artistPic1 ?> alt=<?= $artistName1 . "_Picture" ?> />
                <figcaption id="slideText1" style="display: none"><?= $artistName1 ?></figcaption>
            </figure>
            <figure>
                <img id="slide2" style="display: none" src=<?= $artistPic2 ?> alt=<?= $artistName2 . "_Picture" ?> />
                <figcaption id="slideText2" style="display: none"><?= $artistName2 ?></figcaption>
            </figure>
            <figure>
                <img id="slide3" style="display: none" src=<?= $artistPic3 ?> alt=<?= $artistName3 . "_Picture" ?> />
                <figcaption id="slideText3" style="display: none"><?= $artistName3 ?></figcaption>
            </figure>
        </section>
    </article>

    <article class="events">
        <figure class="event">
            <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name"></a>
            <figcaption>
                <h4>Laval</h4>
                <h2>Charlotte Cardin</h2>
                <h4>Feb 8 2023</h4>
            </figcaption>
        </figure>
        <figure class="event">
            <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name"></a>
            <figcaption>
                <h4>Laval</h4>
                <h2>Charlotte Cardin</h2>
                <h4>Feb 8 2023</h4>
            </figcaption>
        </figure>
        <figure class="event">
            <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name"></a>
            <figcaption>
                <h4>Laval</h4>
                <h2>Charlotte Cardin</h2>
                <h4>Feb 8 2023</h4>
            </figcaption>
        </figure>
        <figure class="event">
            <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name"></a>
            <figcaption>
                <h4>Laval</h4>
                <h2>Charlotte Cardin</h2>
                <h4>Feb 8 2023</h4>
            </figcaption>
        </figure>
        <figure class="event">
            <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name"></a>
            <figcaption>
                <h4>Laval</h4>
                <h2>Charlotte Cardin</h2>
                <h4>Feb 8 2023</h4>
            </figcaption>
        </figure>
        <figure class="event">
            <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name"></a>
            <figcaption>
                <h4>Laval</h4>
                <h2>Charlotte Cardin</h2>
                <h4>Feb 8 2023</h4>
            </figcaption>
        </figure>
        <figure class="event">
            <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name"></a>
            <figcaption>
                <h4>Laval</h4>
                <h2>Charlotte Cardin</h2>
                <h4>Feb 8 2023</h4>
            </figcaption>
        </figure>
        <figure class="event">
            <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name"></a>
            <figcaption>
                <h4>Laval</h4>
                <h2>Charlotte Cardin</h2>
                <h4>Feb 8 2023</h4>
            </figcaption>
        </figure>
        <figure class="event">
            <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name"></a>
            <figcaption>
                <h4>Laval</h4>
                <h2>Charlotte Cardin</h2>
                <h4>Feb 8 2023</h4>
            </figcaption>
        </figure>

    </article>
    <script src="javascript/index.js"></script>
</body>

</html>