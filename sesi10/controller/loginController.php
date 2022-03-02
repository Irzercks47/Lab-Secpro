<?php
include '../database/db.php';

$name = $_POST['name'];
$password = $_POST['password'];
// $sql = "SELECT * FROM users WHERE name = '$name' AND password = '$password'";
// $result = $conn->query($sql);
//cara menghindari sql injection pada login bisa menggunakan prepared statement
//prepared statement 
$sql = "SELECT * FROM users WHERE name = ? AND password = ?";
$statement = $conn->prepare($sql);
$statement->bind_param("ss", $name, $password);
$statement->execute();
$result = $statement->get_result();

if ($result->num_rows == 1) {
    header("Location: ../index.php");
} else {
    header("Location: ../login.php?error=Invalid credentials");
}
