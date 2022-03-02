<?php
    $addr = "localhost";
    $uname = "root";
    $passwd = "";
    $database = "sodiblog_db";
    
    $connection = new mysqli($addr,$uname,$passwd,$database);
    if($connection->connect_error){
        die("Connection Failed!" . $connection->connect_error);
    }
?>