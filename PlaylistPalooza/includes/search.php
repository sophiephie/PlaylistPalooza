<?php
// Check if the search form has ben submitted
if (isset($_POST['search'])) {
  // Retrieve the search query from the form input
  $search = $_POST['search'];
  // Check if the search query is not empty
  if (!empty($search)) {
    header("location: searchResult.php?search={$search}");
  } else {
    // Error message if the search query is empty
    $searchErr = "Nothing is found";
  }
}
?>

<div class="container w-50">
  <form class="form-horizontal" action="#" method="post">
    <div class="row">
      <div class="form-group">
        <div class="col-sm-4">
          <input type="text" class="form-control" name="search" placeholder="Search"
            onkeydown="if (event.keyCode === 13) this.form.submit();">
        </div>
      </div>
    </div>
  </form>
</div>