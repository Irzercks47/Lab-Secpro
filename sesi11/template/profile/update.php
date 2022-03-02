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
        $fullname                = $_POST['fullname'];
        $email                   = $_POST['email'];
        $password                = $_POST['password'];
        $newpassword             = $_POST['newpassword'];
        $newpasswordconfirm      = $_POST['newpasswordconfirm'];

        if(trim($fullname) == '' || trim($email) == ''){
            add_error('All fields must be filled');
            redirect('../profile.php');
        }
        else if(!ctype_alnum($fullname)){
            add_error('Name must be alphanumeric');
            redirect('../profile.php');
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            add_error('Invalid email');
            redirect('../profile.php');
        }

        $query = "SELECT * FROM `users` WHERE `username`=? AND `password`=SHA1(?) LIMIT 1";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ss", $_SESSION['username'], $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if($result->num_rows > 0 && $user_data = $result->fetch_object()){
            if($email != $user_data->email){
                $query = "SELECT * FROM `users` WHERE `email`=?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();

                if($result->num_rows > 0){
                    add_error('Email is used by another account');
                    redirect('../profile.php');
                }
            }

            if($newpassword == '' && $newpasswordconfirm == ''){
                $query = "UPDATE `users` SET
                                `fullname` = ?,
                                `email` = ?
                            WHERE `username` = ?
                                AND `password` = SHA1(?)";
                $stmt = $connection->prepare($query);
                $stmt->bind_param("ssss", $fullname, $email, $_SESSION['username'], $password);
                $stmt->execute();
            }
            else if($newpassword == $newpasswordconfirm){
                $query = "UPDATE `users` SET
                                `fullname` = '$fullname',
                                `email` = '$email',
                                `password` = SHA1('$newpassword')
                            WHERE `username` = '$_SESSION[username]'
                                AND `password` = SHA1('$password')";
                $stmt = $connection->prepare($query);
                $stmt->bind_param("ssss", $fullname, $email, $_SESSION['username'], $password);
                $stmt->execute();
            }
            else{
                add_error("New password and confirm password do not match");
                redirect('../profile.php');
            }

            if($stmt->affected_rows > 0){
                $_SESSION['email']      = $email;
                $_SESSION['fullname']   = $fullname;
                add_success("Data successfuly updated!");
            }
            $stmt->close();
        }
        else{
            add_error("Wrong current password");
            redirect('../profile.php');
        }

        redirect('../profile.php');
    }
}

http_response_code(405);