<!DOCTYPE html>
<html>

<head>
  <link href="images/icon2.png" rel="icon" />

  <!-- Add Bootstrap CSS link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <!-- Link to your custom CSS file -->
  <link rel="stylesheet" href="/Code/css/styles.css" />

  <!-- Link to google font api -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@100;400&display=swap"
    rel="stylesheet" />
</head>

<body>
  <!-------------------->
  <!-- NAVIGATION BAR -->
  <!-------------------->

  <nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
      <!-- Logo on the left (replace this with your logo) -->
      <a class="navbar-brand" href="#"><img src="images/logo2.png" alt="Playlist Palooza" height="39" width="245" /></a>

      <!-- Search bar in the center -->
      <form class="d-flex search-bar" action="search.php" method="GET">
        <input class="form-control" type="text" name="query" placeholder="Search" aria-label="Search" />
      </form>

      <!-- Navigation links -->
      <div class="navbar-nav">
        <a class="nav-link" href="index.php">Home</a>
        <a class="nav-link" href="#">About Us</a>
        <?php
        session_start();
        if (isset($_SESSION['user_id'])) {
          // If the user is logged in, display a "Log Out" link
          echo '<a class="nav-link" href="/logout.php">Log Out</a>';
        } else {
          // If the user is not logged in, display a "Sign In" link
          echo '<a class="nav-link" href="/Code/login.html">Sign In</a>';
        }
        ?>
      </div>
    </div>
  </nav>
</body>

</html>