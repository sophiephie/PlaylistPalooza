<?php
if (isset($_POST['search'])) {
  $search = $_POST['search'];
  if (!empty($search)) {
    header("location: searchResult.php?search={$search}");
  } else {
    $searchErr = "Please enter the artist name";
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