<?php
require "./../database/connection.php";
session_start();

if (isset($_SESSION["CURRENTUSERNAME"])) {
    exit(header('Location: ./../../index.php'));
}

#Question 5 Section 2B OF 3: Cross-Site Request Forgery 
#Section Starts Here
if (isset($_POST["_token"]) && $_POST["token"] == $_SESSION["token"]) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email)) {
        $_SESSION["error"] = "[!] Error: Email must be filled!";
        exit(header('Location: ./../../login.php'));
    }

    if (empty($password)) {
        $_SESSION["error"] = "[!] Error: Password must be filled!";
        exit(header('Location: ./../../login.php'));
    }

    #Question 6 Section 3 OF 6: SQL Injection
    #Section Starts Here
    $sql = "SELECT * FROM tblUsers WHERE user_email = '?'";
    $statement = $conn->prepare($sql);
    $statement->bind_param("s", $user_email);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows == 1) {
        header("Location: ../index.php");
    } else {
        header("Location: ../login.php?error=Invalid credentials");
    }
    #Section Ends Here

    if ($result->num_rows <= 0) {
        $_SESSION["error"] = "[!] Error: Invalid email and password combination!";
        exit(header('Location: ./../../login.php'));
    }

    $row = $result->fetch_assoc();
    #Question 2 Section 2 OF 2: Password Hashing
    #Section Starts Here
    $sql = "select * from tblUsers where user_email = '$email' ";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result = $result->fetch_assoc();
        if (password_verify($password, $user['user_password'])) {
            $_SESSION['user_fullname'] = $user['user_fullname'];
            header("Location: ./index.php");
        }
    } else {
        $_SESSION['error'] = "Wrong username or password";
        header("Location: ./login.php");
        return;
    }
    #Section Ends Here



    #Question 1 Section 1 OF 2: Generate Session 
    #Section Starts Here
    session_regenerate_id();
    #Section Ends Here
}
#Section Ends Here


exit(header('Location: ./../../index.php'));
