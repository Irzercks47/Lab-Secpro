<?php
include './database/db.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session 8</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    include './header.php';
    $sql = "SELECT * FROM posts";

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $sql = "SELECT * FROM posts WHERE content LIKE '%$search%'";
    }
    $result = $conn->query($sql);
    ?>
    <div class="flex flex-col px-8 py-4">
        <div class="font-bold text-xl">
            All posts
        </div>

        <?php
        if (isset($_GET['search'])) {
        ?>
            <div class="font-bold">
                You searched for <?= $_GET['search'] ?>
            </div>
        <?php
        }
        ?>

        <div class="mt-4">
            <form action="./controller/postController.php" method="post" class="flex">
                <input type="text" name="content" class="w-96 shadow-sm block border-gray-300 rounded-md px-4 py-2 border border-gray-300 outline-none" placeholder="Content">
                <button type="submit" class="bg-blue-500 text-white rounded-md py-2 px-4 ml-3" value="insert" name="action">Insert</button>
            </form>
        </div>

        <div class="flex flex-col mt-8">
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="border border-gray-300 p-4 rounded-md mb-3">
                    <?= htmlentities($row['content'])  ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>