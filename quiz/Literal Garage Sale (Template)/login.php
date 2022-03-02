<!DOCTYPE html>
<html lang="en">

<?php
include "./db.php";

if (isset($_SESSION['username'])) {
    header("Location: ./index.php");
    return;
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeGS | Login</title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <?php require "component_header.php" ?>
    <?php require "component_background.php" ?>

    <!-- Redirect to Home page if user is logged in -->
    <!-- starts HERE -->

    <!-- ends HERE -->

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Login</h5>
                        <hr class="my-4">
                        <form class="form-signin" action="./loginController.php" method="POST">
                            <div class="form-label-group mt-4">
                                <input type="text" name="email" class="form-control" placeholder="Email address" autofocus>
                            </div>
                            <div class="form-label-group mt-3">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <hr class="my-4">
                            <button class=" mt-4 btn btn-lg btn-primary btn-block text-uppercase" type="submit">Login</button>
                        </form>
                        <p class="text-danger">
                            <!-- Show error message if there is a login error -->
                            <!-- starts HERE -->
                            <?php
                            if (isset($_SESSION["error"])) {
                                echo $_SESSION["error"];
                                unset($_SESSION["error"]);
                            }

                            ?>
                            <!-- ends HERE -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require "./component_footer.php" ?>


    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>