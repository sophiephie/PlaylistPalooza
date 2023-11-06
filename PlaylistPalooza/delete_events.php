<?php
session_start();
include "includes/adminHeader.php";
include "includes/dbConnect.php";

if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    $db->beginTransaction();

    // Delete associated orders first
    $sqlDeleteOrders = "DELETE FROM orders WHERE eventId = :eventId";
    $stmtDeleteOrders = $db->prepare($sqlDeleteOrders);
    $stmtDeleteOrders->bindParam(':eventId', $eventId);
    $stmtDeleteOrders->execute();

    // Delete associated tickets
    $sqlDeleteTickets = "DELETE FROM tickets WHERE event_Id = :eventId";
    $stmtDeleteTickets = $db->prepare($sqlDeleteTickets);
    $stmtDeleteTickets->bindParam(':eventId', $eventId);
    $stmtDeleteTickets->execute();

    // Delete event data from the database
    $sql = "DELETE FROM events WHERE eventId = :eventId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':eventId', $eventId);
    $stmt->execute();

    // Commit the transaction
    $db->commit();

    // Redirect back to the events management page
    header("Location: eventsPanel.php");
    exit;
}
