<?php

$conn = mysqli_connect('localhost', 'root', '', 'sesi10');

if ($conn->connect_error) {
    die("Connection to DB failed!");
}

session_start();
