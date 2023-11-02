<?php
require 'includes/dbConnect.php';

if (isset($_GET['search'])) {
  $searchTerm = $_GET['search'];
  if (!empty($searchTerm)) {
    $sql = "SELECT * FROM artist WHERE artistName LIKE :search";
    $stmt = $db->prepare($sql);
    $searchParam = '%' . $searchTerm . '%';
    $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
    $stmt->execute();
    $artistDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    //TODO: No results
    print_r("NO RESULTS FOUND");
  }
}

include "includes/header.php";
?>

<!DOCTYPE html>
<html>

<head>
  <title>Playlist Palooza Search Results</title>
</head>

<body>
  <div class="container">
    <h3><u>Search Result</u></h3><br />
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Artist Name</th>
            <!-- Add other artist details columns here -->
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($artistDetails)): ?>
            <?php foreach ($artistDetails as $key => $value): ?>
              <tr>
                <td>
                  <?php echo $key + 1; ?>
                </td>
                <td>
                  <?php echo $value['artistName']; ?>
                </td>
                <!-- Add other artist details columns here -->
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php
  include "includes/footer.html";
  ?>

</body>

</html>