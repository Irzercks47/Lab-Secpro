<?php
    include 'db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    //cek apakah input ada di dalam database
    // $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
    //hashed sha 1
    // $sha1 = sha1($password);
    // $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$sha1' ";
    
    //hashed bcrypt
    //bcrpyt caranya tidak sama seperti sha1 bcrpyt menggunakan password verify
    //menggunakan detc assoc
    $sql = "SELECT * FROM users WHERE username = '$username' ";


    $result = $conn -> query($sql);
    //untuk cek apakah data ada
    //lebih aman menggunakan (== 1) dari pada ( > 0)
    if($result -> num_rows == 1){
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])){
            if(isset($_POST['remember'])){
                //cookie disimpan selama 1 jam untuk + 3600
                //cookie berlaku disemua tempat menggunakan '/'
                setcookie('username', $username, time() + 3600, '/' );
            }
            session_regenerate_id(true);
            header("Location: index.php");
        }
    }
