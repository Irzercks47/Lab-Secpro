<?php
include './database/db.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session 10</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    include './header.php';
    $id = $_GET['id'];
    // $sql = "SELECT * FROM posts WHERE id = $id";
    // $data = $conn->query($sql)->fetch_assoc();
    //prepared statement
    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $id);
    $statement->execute();
    $result = $statement->get_result();

    $data = $result->fetch_assoc();
    ?>

    <?php
    if ($result->num_rows == 0) {
    ?>
        <div>Post data is not found</div>
    <?php
    } else {
        $data = $result->fetch_assoc();
    ?>
        <div class="border border-gray-300 rounded-md p-6 mx-10 mt-10">
            <div class="font-bold text-xl">
                <?= $data['title'] ?>
            </div>
            <div class="mt-4">
                <?= $data['content'] ?>
            </div>
            <div class="mt-4">
                Posted on <?= $data['date'] ?>
            </div>
            <div class="mt-10">
                <span> Upvote : <?= $data['upvote'] ?></span>
                <span class="ml-10"> Downvote : <?= $data['downvote'] ?></span>
            </div>
        </div>
    <?php
    }
    ?>

</body>

</html>