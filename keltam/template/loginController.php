<?php
include "./db.php";
$username = $_POST['txtUsername'];
$password = $_POST['txtPassword'];

if ($username == '') {
    //error message
    $_SESSION['error'] = "Username Must be filled";
    header("Location: ./login.php");
    return;
    //query string
} else if ($password == '') {
    //error message
    $_SESSION['error'] = "Password Must be filled";
    header("Location: ./login.php");
    return;
}

//kalau algo sha1
// $hashed = sha1($password);
// $sql = "select * from users where username = '$username' and password = '$hashed' ";
// $result = $conn->query($sql);

// if ($result->num_rows == 1) {
//     $user = $result = $result->fetch_assoc();
//     $_SESSION['username'] = $user['username'];
//     header("Location: ./index.php");
// } else {

//     $_SESSION['error'] = "Wrong username or password";
//     header("Location: ./login.php");
//     return;
// }

//kalau algo bcrpyt
$sql = "select * from users where username = '$username' ";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result = $result->fetch_assoc();
    //depan yg mau dicek belakang yang udh jadi
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: ./index.php");
    }
} else {
    $_SESSION['error'] = "Wrong username or password";
    header("Location: ./login.php");
    return;
}
