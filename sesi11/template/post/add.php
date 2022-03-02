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

        $content = $_POST['content'];

        if(trim($content) == ''){
            redirect('../index.php');
        }

        $query = "INSERT INTO `posts` (`content`, `user_id`) VALUES (?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("si", $content, $_SESSION['id']);
        $stmt->execute();
        $stmt->close();

        redirect('../index.php');
    }
}

http_response_code(405);