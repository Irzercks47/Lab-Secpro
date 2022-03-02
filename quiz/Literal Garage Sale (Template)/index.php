<?php
include "./db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeGS | Welcome!</title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <?php require "component_header.php" ?>
    <?php require "component_background.php" ?>

    <div class="container">
        <div class="row">
            <!-- show every garage from database -->
            <!-- starts HERE -->
            <?php
            $sql = "SELECT *FROM tblgarages";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="col-sm-3 mt-5">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?= "assets/img/garages/" . $row['garage_image'] ?>" alt="<?= "assets/img/garages/" . $row['garage_image'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['garage_name'] ?></h5>
                            <p class="card-text"><?= $row['garage_price'] ?></p>
                        </div>
                        <div class="card-footer">
                            <!-- if user is logged in, show purchase button. -->
                            <!-- starts HERE -->
                            <a class="btn btn-info" href="[Do purchase operation]">Purchase</a>
                            <!-- ends HERE -->
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <!-- ends HERE -->
        </div>
    </div>

    <?php require "./component_footer.php" ?>

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>