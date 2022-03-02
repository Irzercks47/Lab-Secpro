<?php
include '../database/db.php';

$name = $_POST['name'];
$password = $_POST['password'];
$sql = "SELECT * FROM users WHERE name = '$name' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    setcookie("name", $name, time() + 60 * 60 * 24 * 7, "/", null);
    header("Location: ../index.php");
} else {
    header("Location: ../login.php?error=Invalid credentials");
}
