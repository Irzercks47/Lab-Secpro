<?php
include "./db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeGS | Add New Garage</title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <?php require "component_header.php" ?>
    <?php require "component_background.php" ?>

    <!-- Redirect to Home page if user not logged in -->
    <!-- starts HERE -->
    <?php if (!isset($_SESSION["user_fullname"])) {
        header("Location: ./index.php");
    } else {
    ?>
        <!-- ends HERE -->

        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Add New Garage</h5>
                            <hr class="my-4">
                            <form class="form-signin" action="[Do add garage operation]" method="POST" enctype="multipart/form-data">
                                <div class="form-label-group mt-4">
                                    <input type="text" name="name" class="form-control" placeholder="New garage name" autofocus>
                                </div>
                                <div class="form-label-group mt-3">
                                    <input type="number" name="price" class="form-control" placeholder="New garage price">
                                </div>
                                <div class="form-label-group mt-3">
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                <hr class="my-4">
                                <button class=" mt-4 btn btn-lg btn-primary btn-block text-uppercase" type="submit">Add new garage!</button>
                            </form>
                            <p class="text-danger">
                                <!-- Show error message if there is an adding error -->
                                <!-- starts HERE -->

                                <!-- ends HERE -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

    <?php require "./component_footer.php" ?>


    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>