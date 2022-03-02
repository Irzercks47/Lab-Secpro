<?php
    include '../database/db.php';

    if($_POST['action'] == "insert"){
        $content = $_POST['content'];
        $sql = "INSERT INTO `posts` (`id`, `content`) VALUES(NULL, '$content')";
        $conn->query($sql);
        header("Location: ../index.php");
    }
?>