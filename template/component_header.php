<?php session_start(); ?>
<link rel="stylesheet" href="./css/header.css">
<nav class="navbar navbar-expand-lg navbar-light text-light sticky-top">
    <a class="navbar-brand text-light font-weight-bold ml-5" href="./index.php">SodiBlog</a>
    <p class="navbar-nav">
        Welcome,
        <?php if(!isset($_SESSION['CURRENTUSERNAME'])) {
            echo "Guest!";
        }
        else {
            echo $_SESSION['CURRENTUSERNAME'];
        } ?>
    </p>
    <div class="collapse navbar-collapse mr-5" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto topnav">
            <li class="nav-item">
                <a class="nav-link text-light" href="./index.php">Home</a>
            </li>
            <?php if(!isset($_SESSION['CURRENTUSERNAME'])) { ?>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white ml-4" type="button" href="./login.php">Login</a>
                </li>
            <?php } ?>
            <?php if(!isset($_SESSION['CURRENTUSERNAME'])) { ?>
                <li class="nav-item">
                    <a class="nav-link btn btn-success text-white ml-1" type="button" href="./register.php">Register</a>
                </li>
            <?php } ?>
            <?php if(isset($_SESSION['CURRENTUSERNAME'])) { ?>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white ml-4" type="button" href="./helpers/controllers/doLogout.php">Logout</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>