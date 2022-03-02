<?php

define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'/helpers/session.php'); 
require_once(__ROOT__.'/helpers/function.php'); 
require_once(__ROOT__.'/controller/connection.php'); 

if($_SESSION['csrf_token'] == $_REQUEST['csrf_token']){
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    if($method == 'POST'){
        if($action == 'login'){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT * FROM `users` WHERE (`username`=? OR `email`=?) AND `password`=SHA1(?) LIMIT 1";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("sss", $username, $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if($result->num_rows > 0 && $user_data = $result->fetch_assoc()){
                $_SESSION['id']         = $user_data['id'];
                $_SESSION['username']   = $user_data['username'];
                $_SESSION['email']      = $user_data['email'];
                $_SESSION['fullname']   = $user_data['fullname'];
                $_SESSION['avatar']     = $user_data['avatar'];
                redirect('../index.php');
            }
            else{
                add_error('Wrong username or password');
                redirect('../login.php');
            }
        }
        else if($action == 'register'){
            $name       = $_POST['name'];
            $username   = $_POST['username'];
            $email      = $_POST['email'];
            $password   = $_POST['password'];

            if(!$name || !$username || !$email || !$password){
                add_error('All fields must be filled');
                redirect('../register.php');
            }
            /*else if(!ctype_alnum($name)){
                add_error('Name must be alphanumeric');
                redirect('../register.php');
            }*/
            else if(!preg_match('/^[a-zA-Z0-9_]/', $username)){
                add_error('Username must only contain alphabet, number, and underscore (_) symbol');
                redirect('../register.php');
            }
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                add_error('Invalid email');
                redirect('../register.php');
            }

            $username_check_query = "SELECT * FROM `users` WHERE `username` = ? OR `email` = ?";
            $stmt = $connection->prepare($username_check_query);
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if($user_data = $result->fetch_assoc()){
                if($user_data['email'] == $email) add_error("Email $email has already been used.");
                else add_error("Username $username has already been taken.");
                redirect('../register.php');
            }
            
            $register_query = "INSERT INTO `users` (`fullname`, `username`, `email`, `password`) VALUES (?, ?, ?, SHA1(?))";
            $stmt = $connection->prepare($register_query);
            $stmt->bind_param("ssss", $name, $username, $email, $password);
            $stmt->execute();
            $stmt->close();

            add_success("You are registered as $username");
            redirect('../login.php');
        }
    }
    else if($method == 'GET'){
        if($action == 'logout'){
            session_destroy();
            redirect('../index.php');
        }
    }
}

http_response_code(405);
