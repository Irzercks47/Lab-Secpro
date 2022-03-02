<?php

$conn = mysqli_connect('localhost', 'root', '', 'session8');

if ($conn->connect_error) {
    die("Connection to DB failed!");
}

session_start();
