<?php
session_start();
include "includes/adminHeader.php";
include "includes/dbConnect.php";

if (isset($_GET['id'])) {
    $artistId = $_GET['id'];

    // Delete event data from the database
    $sql = "DELETE FROM artist WHERE artistId = :artistId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':artistId', $artistId);
    $stmt->execute();

    // Redirect back to the events management page
    header("Location: artistsPanel.php");
    exit;
}
