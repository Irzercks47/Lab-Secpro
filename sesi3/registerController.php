<?php
    include 'db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $age = $_POST['age'];

    if($username == '' || $password == '' || $age == ''){
        $_SESSION['error'] = "All fields must be filled";
        header("Location: register.php");
    }
    elseif(strlen($username) < 3){
        $_SESSION['error'] = "Username must be atleast 3 characters";
        header("Location: register.php");
    }
    else{
        //hashed untuk menyimpan password yang udah di hash
        $hashed = sha1($password);
        //ada fungsi password hash yang parameternya adalah variable apa yang ingin di hash
        // disini adalah password dan algoritmanya
        // $hashed = password_hash($password, PASSWORD_BCRYPT);
        //jika menggunakan hash atau algo hash maka disimpan di variabel dullu lalu di insert bagian password 
        //yang dimasukkan adalah variabel hasill dari hash
        $sql = "INSERT INTO users VALUES(null, '$username', '$hashed', $age)";
        $conn -> query($sql);
        header("Location: login.php");
        return;
    }
    header("Location: register.php");
