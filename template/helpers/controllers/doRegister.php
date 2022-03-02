<?php
require "./../database/connection.php";
session_start();

if (isset($_SESSION["CURRENTUSERNAME"])) {
    exit(header('Location: ./../../index.php'));
}

#Question 5 Section 1B OF 3: Cross-Site Request Forgery 
#Section Starts Here
if (isset($_POST["_token"]) && $_POST["token"] == $_SESSION["token"]) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($fullname)) {
        $_SESSION["error"] = "[!] Error: Full name must be filled!";
        exit(header('Location: ./../../register.php'));
    }

    if (empty($email)) {
        $_SESSION["error"] = "[!] Error: Email must be filled!";
        exit(header('Location: ./../../register.php'));
    }

    if (empty($password)) {
        $_SESSION["error"] = "[!] Error: Password must be filled!";
        exit(header('Location: ./../../register.php'));
    }

    #Question 6 Section 1 OF 6: SQL Injection
    #Section Starts Here
    $sql = "SELECT * FROM tblusers WHERE user_fullname = ? AND user_password = ? AND user_email = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param("sss", $name, $password, $email);
    $statement->execute();
    $result = $statement->get_result();
    // $result = $connection->query("SELECT * FROM tblUsers WHERE user_email = `$email`");
    #Section Ends Here

    if ($result->num_rows > 0) {
        $_SESSION["error"] = "[!] Error: Email already exists!";
        exit(header('Location: ./../../register.php'));
    }

    #Question 2 Section 1 OF 2: Password Hashing
    #Section Starts Here
    $hashed = sha1($password);
    $hashed = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO tblusers VALUES(null, '$fullname', '$email', $hashed)";
    $conn->query($sql);
    header("Location: ../login.php");
    return;
    #Section Ends Here



    #Question 6 Section 2 OF 6: SQL Injection
    #Section Starts Here
    $sql = "INSERT INTO `tblusers` (`user_fullname`, `user_email`, `user_password`) VALUES ('$fullname', '$email', '$password')";
    $statement = $conn->prepare($sql);
    $statement->bind_param("sss", $fullname, $email, $password);
    $statement->execute();
    $result = $statement->get_result();
    #Section Ends Here
}
#Section Ends Here


exit(header('Location: ./../../index.php'));
