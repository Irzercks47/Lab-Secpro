<?php
include "connect.php";


session_start();
if (isset($_POST["_token"]) && $_POST["token"] == $_SESSION["token"]) {
    $new_password = $_POST["new-password"];
    $sql = "update users set password='$new_password'";
    $con->query($sql);
}

header("Location: changepassword.php");
