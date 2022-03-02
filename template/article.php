<?php
require "./helpers/database/connection.php";

$article_id = $_GET["id"];

#Question 6 Section 4 OF 6: SQL Injection
#Section Starts Here
$sql = "SELECT * FROM tblarticles WHERE id = $article_id";
$statement = $conn->prepare($sql);
$statement->bind_param("i", $id);
$statement->execute();
$result = $statement->get_result();
#Section Ends Here

$title = "SodiBlog | Uh-oh, 404!";

if ($result->num_rows != 0) {
    $row_article = $result->fetch_assoc();
    $title = "SodiBlog | " . $row_article["article_title"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/article.css">
</head>

<body>
    <?php require "./component_header.php"; ?>
    <?php require "./component_background.php"; ?>

    <div class="container">
        <?php
        if ($result->num_rows == 0) {
            echo "<h1>We can't find the article you're looking for :(</h1>";
        } else {
        ?>
            <div class="jumbotron mt-5">
                <h1 class="display-4 font-weight-bold"><?= $row_article["article_title"] ?></h1>
                <p>Article by: <?= $row_article["article_source"] ?></p>
                <hr class="my-4">
                <img class="img-fluid rounded mx-auto d-block" style="max-width:100%; height: auto" src="<?= "./assets/img/" . $row_article["article_image"] ?>" alt="">
                <p><?= nl2br($row_article["article_contents"]) ?></p>
            </div>

            <div class="jumbotron pt-4">
                <?php
                #Question 6 Section 5 OF 6: SQL Injection
                #Section Starts Here
                $sql = "SELECT * FROM tblcomments JOIN tblusers ON tblcomments.commenter = tblusers.id WHERE article = $article_id";
                $statement = $conn->prepare($sql);
                $statement->bind_param("i", $article_id);
                $statement->execute();
                $result = $statement->get_result();

                $data = $result->fetch_assoc();
                #Section Ends Here
                ?>
                <h4 class="font-weight-bold">Comments (<?= $result->num_rows ?>)</h4>
                <hr class="my-4">

                <?php while ($row_comment = $result->fetch_assoc()) { ?>
                    <div class="jumbotron pt-3 pb-3" id="comment-fragment">
                        <h3><?= $row_comment["user_fullname"] ?></h3>
                        <p class="lead"><?= $row_comment["comment_content"] ?></p>
                    </div>
                <?php } ?>
            </div>
            <!-- Question 3 Section 1 OF 1: Access Control  -->
            <!-- Section Starts Here  -->
            <?php

            if (!isset($_SESSION['user_fullname'])) {
            ?>
                <div>Belum login</div>
            <?php } else { ?>
                <div class="jumbotron  pt-3 pb-3 text-right" id="add-comment-fragment">
                    <h3 class="text-left">Leave a Comment!</h3>
                    <hr>
                    <form action="./helpers/controllers/doComment.php" method="POST">
                        <!-- Question 5 Section 3A OF 3: Cross-Site Request Forgery  -->
                        <!-- Section Starts Here  -->
                        <?php
                        if (isset($_POST["_token"]) && $_POST["token"] == $_SESSION["token"]) {
                        ?>
                            <!-- Section Ends Here  -->
                            <input type="hidden" name="article_id" value="<?= $article_id ?>">
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                            <input class="mt-3 btn btn-md btn-primary" type="submit" value="Comment">
                    </form>
                    <p class="text-danger text-left">
                        <?php if (isset($_SESSION["error"])) {
                                echo $_SESSION["error"];
                                unset($_SESSION["error"]);
                            } ?>
                    </p>
                </div>
            <?php
                        }
            ?>
            <!-- Section Ends Here  -->
        <?php } ?>
    </div>
<?php
        }
?>


<?php require "./component_footer.php" ?>

<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>