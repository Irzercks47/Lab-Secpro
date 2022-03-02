<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SodiBlog | Welcome!</title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <?php require "./component_header.php" ?>
    <?php require "./component_background.php" ?>

    <div class="container">
        <div class="jumbotron mt-5">
            <h1 class="display-4 font-weight-bold">Make your life <del class="font-weight-normal">sweeter</del> saltier!</h1>
            <p class="lead">Welcome to my SodiBlog! Here, i talk about various seasonings that I came across along my culinary journey.</p>
            <hr class="my-4">
            <h4 class="text-right">"Put a grain of salt in everything."</h4>
            <p class="text-right">-Gordon Ramsay, probably</p>
        </div>

        <div class="row">
            <?php
                require "./helpers/database/connection.php";

                $result = $connection->query("SELECT * FROM tblarticles");

                while($row = $result->fetch_assoc()) {
            ?>
                <a class="col-sm-3 mt-5 text-decoration-none" href="<?= "./article.php?id=".$row["id"] ?>">
                    <div class="card h-100 bg-light">
                        <img class="card-img-top" src="<?= "./assets/img/".$row["article_image"] ?>" alt="<?= $row["article_image"] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row["article_title"] ?></h5>
                            <p class="card-text text-secondary"><?= $row["article_source"] ?></p>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>

    <?php require "./component_footer.php" ?>

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
