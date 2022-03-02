<?php
    require "./../database/connection.php";
    session_start();

    $article_id = $_POST["article_id"];
    $commenter_id = $_SESSION["CURRENTUSERID"];
    $comment_content = $_POST["comment_content"];


    #Question 5 Section 3B OF 3: Cross-Site Request Forgery 
    #Section Starts Here
    if(!isset $_SESSION["_token"] && $_SESSION["_token"] == $_SESSION["token"]){
        $new_comment = $_POST["comment_content"];
        $sql = "update tblcomments set comment_content='$new_comment'";
        $con->query($sql);
    }
    #Section Ends Here



    #Question 4 Section 1 OF 1: Cross-Site Scripting 
    #Section Starts Here
    strip_tags($row['comment_content'], "<b>, <i>, <u>, <h1>, <h2>, <br>")
    #Section Ends Here



    #Question 6 Section 6 OF 6: SQL Injection
    #Section Starts Here
    
    $connection->query("INSERT INTO `tblcomments` (`article`, `commenter`, `comment_content`) VALUES ($article_id, $commenter_id, '$comment_content')");
    #Section Ends Here

    exit(header("Location: ./../../article.php?id=".$article_id."#comment-fragment"));
?>