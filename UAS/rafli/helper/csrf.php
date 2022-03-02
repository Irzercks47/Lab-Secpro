<?php
function generate_token() {
    if (!isset($_SESSION['token'])) {
        // Datetime + IP
        $_SESSION['token'] = md5(date('Y-m-d-H-i-s') . $_SERVER['REMOTE_ADDR']);
    }
    $token = $_SESSION['token'];

    return $token;
}