<?php
include "./db.php";
?>

<nav class="navbar navbar-expand-lg navbar-light bg-warning sticky-top">
    <a class="navbar-brand" href="./index.php">LITERAL GARAGE SALE</a>
    <p class="navbar-nav">
        <!-- show welcome user name if logged in. -->
        <!-- starts HERE -->
        Welcome, <?= isset($_SESSION['user_fullname']) ? $_SESSION['user_fullname'] : "Guest"  ?>
        <!-- ends HERE -->
    </p>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto topnav">
            <li class="nav-item">
                <a class="nav-link" href="./index.php">Home</a>
            </li>
            <!-- show add new garage button if logged in. -->
            <!-- starts HERE -->
            <?php if (isset($_SESSION["user_fullname"])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="./add.php">Add New Garage!</a>
                </li>
            <?php } ?>
            <!-- ends HERE -->



            <!-- show login button if not logged in. -->
            <!-- starts HERE -->
            <?php if (!isset($_SESSION["user_fullname"])) { ?>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white ml-4" type="button" href="./login.php">Login</a>
                </li>
            <?php } else { ?>
                <!-- ends HERE -->



                <!-- show logout button if logged in. -->
                <!-- starts HERE -->
                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white ml-4" type="button" href="./logoutController.php">Logout</a>
                </li>
            <?php } ?>
            <!-- ends HERE -->
        </ul>
    </div>
</nav>