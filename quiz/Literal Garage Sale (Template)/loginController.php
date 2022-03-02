<?php
include "./db.php";
$email = $_POST['email'];
$password = $_POST['password'];

if ($email == '') {
    $_SESSION['error'] = "Email Must be filled";
    header("Location: ./login.php");
    return;
} else if ($password == '') {
    $_SESSION['error'] = "Password Must be filled";
    header("Location: ./login.php");
    return;
}

$sql = "SELECT * FROM tblusers WHERE user_email = '$email' ";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result = $result->fetch_assoc();
    if (password_verify($password, $user['user_password'])) {
        $_SESSION['user_emai'] = $user['user_email'];
        header("Location: ./index.php");
    }
} else {
    $_SESSION['error'] = "Wrong email or password";
    header("Location: ./login.php");
    return;
}
