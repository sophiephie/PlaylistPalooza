<?php
session_start();
include "includes/adminHeader.php";
include "includes/dbConnect.php";

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete user data from the database
    $sql = "DELETE FROM users WHERE userId = :userId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    // Redirect back to the users management page
    header("Location: usersPanel.php");
    exit;
}
