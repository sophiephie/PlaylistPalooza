<?php
include 'dbConnect.php'; // Include your database connection script
$searchErr = '';
$artistDetails = '';

if (isset($_POST['save'])) {
  if (!empty($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM artist WHERE artistName LIKE :search";
    $stmt = $db->prepare($sql);
    $searchParam = '%' . $search . '%';
    $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
    $stmt->execute();
    $artistDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $searchErr = "Please enter the artist name";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Artist Search</title>
  <link rel="stylesheet" href="bootstrap.css" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="bootstrap-theme.css" crossorigin="anonymous">
  <style>
    .container {
      width: 70%;
      height: 30%;
      padding: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h3><u>Search</u></h3>
    <br /><br />
    <form class="form-horizontal" action="#" method="post">
      <div class="row">
        <div class="form-group">
          <label class="control-label col-sm-4" for="email"><b>Search Artist:</b>:</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="search" placeholder="Search for an artist">
          </div>
          <div class="col-sm-2">
            <button type="submit" name="save" class="btn btn-success btn-sm">Submit</button>
          </div>
        </div>
        <div class="form-group">
          <span class="error" style="color:red;">*
            <?php echo $searchErr; ?>
          </span>
        </div>
      </div>
    </form>
    <br /><br />
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
          <?php
          if (!$artistDetails) {
            echo '<tr>No data found</tr>';
          } else {
            foreach ($artistDetails as $key => $value) {
              ?>
              <tr>
                <td>
                  <?php echo $key + 1; ?>
                </td>
                <td>
                  <?php echo $value['artistName']; ?>
                </td>
                <!-- Add other artist details columns here -->
              </tr>
              <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="jquery-3.2.1.min.js"></script>
  <script src="bootstrap.min.js"></script>
</body>

</html>