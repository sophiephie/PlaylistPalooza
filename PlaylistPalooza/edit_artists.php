<?php
session_start();
include "includes/adminHeader.php";
include "includes/dbConnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle form submission to update artist data
  $artistId = $_POST['artistId'];
  $artistName = $_POST['artistName'];

  // Check if a new image file was uploaded
  if ($_FILES['imageFile']['error'] === UPLOAD_ERR_OK) {
    $imageLink = uploadImage($artistId);
    // If a new image is uploaded, update the image link
    updateImageLink($artistId, $imageLink);
  }

  // Update artist data in the database
  $sql = "UPDATE artist SET artistName = :artistName, imageLink = :imageLink WHERE artistId = :artistId";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':artistId', $artistId);
  $stmt->bindParam(':artistName', $artistName);
  $stmt->bindParam(':imageLink', $imageLink);
  $stmt->execute();

  // Redirect back to the artist management page
  header("Location: artistsPanel.php");
  exit;
}

// Function to handle image upload and update the image link in the database
function uploadImage($artistId)
{
  $uploadDir = "images/artistPhotos/"; // Directory to store uploaded images
  $imageFile = $_FILES['imageFile'];

  // Generate a unique filename for the uploaded image
  $imageLink = $uploadDir . uniqid() . '_' . $imageFile['name'];

  // Check if the file is an image
  $imageFileType = strtolower(pathinfo($imageLink, PATHINFO_EXTENSION));
  $allowedExtensions = array("jpg", "jpeg", "png", "gif");

  if (in_array($imageFileType, $allowedExtensions)) {
    $targetPath = $uploadDir . basename($imageLink);

    // Move the uploaded file to the target directory
    move_uploaded_file($imageFile['tmp_name'], $targetPath);

    return $imageLink;
  } else {
    echo "Invalid image file format.";
    return null;
  }
}

// Function to update the image link in the database
function updateImageLink($artistId, $imageLink)
{
  global $db;
  $sql = "UPDATE artist SET imageLink = :imageLink WHERE artistId = :artistId";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':artistId', $artistId);
  $stmt->bindParam(':imageLink', $imageLink);
  $stmt->execute();
}

// Fetch artist data by ID and display an edit form
if (isset($_GET['id'])) {
  $artistId = $_GET['id'];
  $sql = "SELECT * FROM artist WHERE artistId = :artistId";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':artistId', $artistId);
  $stmt->execute();
  $artist = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Artists Management Data Table</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/adminPanel.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();

      $('.edit').click(function() {
        $(this).closest('tr').next('.edit-form').toggle();
      });
    });
  </script>
</head>

<body>
  <div class="container-xl">
    <div class="table-responsive">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="row">
            <div class="col-sm-5">
              <h2>Artists Management</h2>
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Artist Id</th>
              <th>Artist Name</th>
              <th>Image Link</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($artist)) : ?>
              <tr>
                <td><?php echo $artist['artistId']; ?></td>
                <td><?php echo $artist['artistName']; ?></td>
                <td><?php echo $artist['imageLink']; ?></td>
                <td></td>
              </tr>
              <tr class="edit-form">
                <form action="edit_artists.php" method="post" enctype="multipart/form-data">
                  <td><input type="hidden" name="artistId" value="<?php echo $artist['artistId']; ?>"></td>
                  <td><input type="text" name="artistName" value="<?php echo $artist['artistName']; ?>"></td>
                  <td><input type="file" name="imageFile"></td>
                  <td><button type="submit">Save</button></td>
                </form>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>
<?php include "includes/footer.html"; ?>