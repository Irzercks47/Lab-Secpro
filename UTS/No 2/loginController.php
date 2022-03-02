<?php
include './getipaddress.php';
session_start();
session_regenerate_id();

$myuser = "jajang";
$mypass = "handal";
if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == $myuser and $password == $mypass) {
        $_SESSION['last_access'] = time();
        $_SESSION['ip_address'] = get_ip_address();
        $_SESSION['user_agent'] = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';
    } else if (time() - $_SESSION['last_access'] > 3600) {
        session_regenerate_id(true);
        $_SESSION['last_access'] = time();
    } else {
        echo "Username and password are wrong ";
    }
} else {
    if ($_SESSION['ip_address'] !== get_ip_address() and !isset($_SERVER['HTTP_USER_AGENT']) || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
        session_destroy();
        $_SESSION = array();
        if (!headers_sent()) {
            header("Location: ./login.php");
            exit;
        } else {
            exit;
        }
    }
}
