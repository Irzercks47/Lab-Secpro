<?php

$mysqli = new mysqli(
    getenv("DB_HOST"),
    getenv("DB_USER"),
    getenv("DB_PASS"),
    getenv("DB_NAME")
);

if ($mysqli->errno) {
    echo '<pre>';
    echo sprintf("Failed connect to database: %s\n", $conn->connect_error);
    echo '</pre>';
    exit;
}