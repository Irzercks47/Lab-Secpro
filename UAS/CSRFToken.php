<?php
function csrf_token()
{
    $token = '';

    if(!isset($_SESSION['token'])){
    // random character lenght 32
        $_SESSION['token'] = md5(date('Y-m-d-H-i-s'). $_SERVER['REMOTE_ADDR']);
    }

    $token = $_SESSION['token'];

    return $token;
}
