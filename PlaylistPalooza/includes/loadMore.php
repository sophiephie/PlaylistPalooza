<?php

require "dbConnect.php";

$limit = $_POST['limit'];

$sql = "SELECT * FROM events ORDER BY date limit $limit,3";

$query = $db->prepare($sql);
$query->execute();

$html = "";

while ($row = $query->fetch()) {
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

	$html .= "<figure class='eventCards col'>";
	$html .= "<a href=" . $link . "> <img class='img-fluid' src='" . $mainArtist['imageLink'] . "' alt='picture_of_artist'></a>";
	$html .= "<figcaption>";
	$html .= "<h4>" . $rowLoc['locationName'] . "</h4>";
	$html .= "<h2>" . $mainArtist['artistName'] . "</h2>";
	$html .= "<h3>with " . $openArtist['artistName'] . "</h3>";
	$html .= "<h4>" . date('F j, Y', strtotime($row['date'])) . "</h4>";
	$html .= "</figcaption>";
	$html .= "</figure>";
}

echo $html;
