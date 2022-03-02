<?php
include "./db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Smartphone</title>
  <meta charset="utf-8">

  <?php include_once 'helper/template/include.php'; ?>
</head>

<body>

  <?php include_once 'helper/template/header.php'; ?>

  <div class="container text-center">
    <!-- Searching -->
    <div class="search">
      <form action="" method="POST">
        <input type="text" name="search" id="inputSearch" placeholder="Search smartphone type..">
        <button type="submit" id="btnSearch"><i class="fa fa-search" aria-hidden="true"></i></button>
      </form>
    </div>
    <h3>

      <!-- View After Login -->

      Welcome, <?= isset($_SESSION['username']) ? $_SESSION['username'] : "Guest"  ?>
      <!--Change With Username -->
    </h3><br>
    <div class="row">
      <!-- Show All Products and Searching -->
      <?php
      $sql = "SELECT *FROM handphone";
      $result = $conn->query($sql);

      while ($row = $result->fetch_assoc()) {
      ?>
        <div class="col-sm-4 distance">
          <p><b><?= $row['brand'] ?></b></p> <!-- Show smartphone brand from database -->
          <!-- Image from path public/image/product/{image} -->
          <center>
            <img src=<?= "./public/image/product" . $row['image'] ?> class="img-responsive" alt="Image"> <!-- {image} = image from database -->
          </center>
          <p><?= $row['type'] ?></p> <!-- Show smartphone type from database -->
          <p><?= $row['price'] ?></p> <!-- Show smartphone price from database -->
          <!-- Show Button Update and Delete -->
          <?php
          if (isset($_SESSION['username'])) {
          ?>
            <a class="btn btn-warning" href="<?= "update.php" ?>">Update</a>
            <form action="" method="post">
              <input type="hidden" name="id" value=<?= $row['id'] ?> <button type="submit" value="delete" name="action">Delete</button>
            </form>
            <a class="btn btn-danger" href="">Delete</a>
          <?php
          }
          ?>

        </div>

        <!-- Example -->
        <div class="col-sm-4 distance">
          <p><b>Samsung</b></p>
          <center>
            <img src="public/image/product/samsungs7.png" class="img-responsive" alt="Image">
          </center>
          <p>Samsung Galaxy S7</p>
          <p>Rp 10000000</p>
          <a class="btn btn-warning" href="update.php">Update</a>
          <a class="btn btn-danger" href="">Delete</a>
        </div>

      <?php
      }
      ?>

      <!-- End Show Products -->
    </div>
  </div><br>

  <?php include_once 'helper/template/footer.php' ?>

</body>

</html>