<?php
require('config.php'); // Include your database connection file

if (isset($_GET['query'])) {
  $searchQuery = $_GET['query'];

  // Prepare and execute a SQL query to search for artists
  $sql = "SELECT * FROM artist WHERE artistName LIKE :query";
  $searchResult = $pdo->prepare($sql);
  $searchResult->bindParam(':query', "%$searchQuery%", PDO::PARAMS_STR);
  $searchResult->execute();

  // Display search results
  echo "<h2>Search Results</h2>";
  echo "<ul>";
  while ($row = $searchResult->fetch(PDO::FETCH_ASSOC)) {
    echo "<li><a href='#'>" . $row['artistName'] . "</a></li>";
  }
  echo "</ul>";
} else {
  echo "Nothing is found.";
}
?>