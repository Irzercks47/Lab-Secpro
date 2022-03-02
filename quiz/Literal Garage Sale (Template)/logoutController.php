<?php
include "db.php";
unset($_SESSION['user_fullname']);
header("Location: ./index.php");
