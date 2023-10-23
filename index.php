<?php
$artistPic1 = "https://www.evenko.ca/_uploads/event/51087/featured.jpg?v=1670334813";
$artistPic2 = "https://www.evenko.ca/_uploads/event/57675/featured.jpg?v=1697740433";
$artistPic3 = "https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863";
$artistName1 = "Artist_Name_1";
$artistName2 = "Artist_Name_2";
$artistName3 = "Artist_Name_3";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css" />
    <title>Playlist Palooza</title>
</head>

<body>
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
                        <img src="<?= $artistPic1 ?>" class="d-block w-100" alt="..." />
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>
                                Some representative placeholder content for the first slide.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?= $artistPic2 ?>" class="d-block w-100" alt="..." />
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>
                                Some representative placeholder content for the second slide.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?= $artistPic3 ?>" class="d-block w-100" alt="..." />
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
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

    <article class="container-fluid">
        <section class="row mt-2">
            <figure class="col">
                <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name" width="100%"></a>
                <figcaption>
                    <h4>Laval</h4>
                    <h2>Charlotte Cardin</h2>
                    <h4>Feb 8 2023</h4>
                </figcaption>
            </figure>
            <figure class="col">
                <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name" width="100%"></a>
                <figcaption>
                    <h4>Laval</h4>
                    <h2>Charlotte Cardin</h2>
                    <h4>Feb 8 2023</h4>
                </figcaption>
            </figure>
            <figure class="col">
                <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name" width="100%"></a>
                <figcaption>
                    <h4>Laval</h4>
                    <h2>Charlotte Cardin</h2>
                    <h4>Feb 8 2023</h4>
                </figcaption>
            </figure>
        </section>
        <section class="row">
            <figure class="col">
                <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name" width="100%"></a>
                <figcaption>
                    <h4>Laval</h4>
                    <h2>Charlotte Cardin</h2>
                    <h4>Feb 8 2023</h4>
                </figcaption>
            </figure>
            <figure class="col">
                <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name" width="100%"></a>
                <figcaption>
                    <h4>Laval</h4>
                    <h2>Charlotte Cardin</h2>
                    <h4>Feb 8 2023</h4>
                </figcaption>
            </figure>
            <figure class="col">
                <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name" width="100%"></a>
                <figcaption>
                    <h4>Laval</h4>
                    <h2>Charlotte Cardin</h2>
                    <h4>Feb 8 2023</h4>
                </figcaption>
            </figure>
        </section>
        <section class="row">
            <figure class="col">
                <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name" width="100%"></a>
                <figcaption>
                    <h4>Laval</h4>
                    <h2>Charlotte Cardin</h2>
                    <h4>Feb 8 2023</h4>
                </figcaption>
            </figure>
            <figure class="col">
                <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name" width="100%"></a>
                <figcaption>
                    <h4>Laval</h4>
                    <h2>Charlotte Cardin</h2>
                    <h4>Feb 8 2023</h4>
                </figcaption>
            </figure>
            <figure class="col">
                <a href=#> <img src="https://www.evenko.ca/_uploads/event/57640/featured.jpg?v=1696253863" alt="artist name" width="100%"></a>
                <figcaption>
                    <h4>Laval</h4>
                    <h2>Charlotte Cardin</h2>
                    <h4>Feb 8 2023</h4>
                </figcaption>
            </figure>
        </section>
    </article>
    <script src="javascript/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>