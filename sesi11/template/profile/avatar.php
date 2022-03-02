<?php

define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'/helpers/session.php'); 
require_once(__ROOT__.'/helpers/function.php'); 
require_once(__ROOT__.'/controller/connection.php'); 

if(!isset($_SESSION['username'])){
	redirect('index.php');
}

if($_SESSION['csrf_token'] == $_REQUEST['csrf_token']){
    $method = strtoupper($_SERVER['REQUEST_METHOD']);

    if($method == 'POST'){
        $upload_path = 'uploads/avatars/';

        $file_extension = strtolower(pathinfo(basename($_FILES["avatarfile"]["name"]), PATHINFO_EXTENSION));
        $file_name = $_SESSION['username'] . "." . $file_extension;

        $file_path = $upload_path . $file_name;

        move_uploaded_file($_FILES["avatarfile"]["tmp_name"], "../" . $file_path);

        $query = "UPDATE `users` SET `avatar`=? WHERE id=?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("si", $file_path, $_SESSION['id']);
        $stmt->execute();
        $stmt->close();

        $_SESSION['avatar'] = $file_path;

        redirect('../profile.php');
    }
}

http_response_code(405);