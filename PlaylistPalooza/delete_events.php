<?php

include "includes/header.php";
include "includes/dbConnect.php";

if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    // Delete event data from the database
    $sql = "DELETE FROM events WHERE eventId = :eventId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':eventId', $eventId);
    $stmt->execute();
    
    // Redirect back to the events management page
    header("Location: eventssPanel.php");
    exit;
}