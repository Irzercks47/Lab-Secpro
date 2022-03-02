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

    $response['success'] = false;

    if($method == 'POST'){
        $content = $_POST['content'];
        $post_id = $_POST['post_id'];

        $response;

        if(trim($content) == ''){
            json_response($response, 200);
        }
        $content = htmlentities($content);

        $query = "INSERT INTO `comments` (`content`, `post_id`, `user_id`) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sii", $content, $post_id, $_SESSION['id']);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            $response['success'] = true;
            $response['comment'] = $content;
            $response['post_id'] = $post_id;
            $response['created_at'] = date("d M Y H:i");
        }
        $stmt->close();
    }
}

json_response($response, 200);