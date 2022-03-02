<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HeFood</title>
    <style>
        .box {
            border: 1px solid black;
            margin-bottom: 10px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <h1>HeFood</h1>
    <a href="./add.php">Add New Food</a>
    <hr>
    <?php
    include "./connection.php";

    $query = "SELECT * FROM foods";
    $result = $conn->query($query);
    //untuk mengambill semua isi data tidak bisa hanya menggunakan fetch_all harus dimasukin for loop
    //hanya bisa ambill index
    // $rows = $result->fetch_all();
    // for ($i = 0; $i < count($rows); $i++) {
    //     var_dump($rows[$i]);
    //     echo "<br>";
    // }
    // // untuk akses data bisa menggunakan while loop
    // while ($column = $result->fetch_array()) {
    //     var_dump($column);
    //     echo "<br>";
    // }

    //assoc hanya bisa mengambil nama column dan bisa menggunakan while loop
    // while ($column = $result->fetch_assoc()) {
    //     var_dump($column);
    //     echo "<br>";
    // }

    // //fetch row untuk akses kita harus menggunakan index dan bisa menggunakan while loop
    // while ($column = $result->fetch_row()) {
    //     var_dump($column);
    //     echo "<br>";
    // }
    while ($column = $result->fetch_assoc()) {
    ?>
        <div class="box">
            Id: <?php echo $column["food_id"]; ?> <br>
            Name:<?php echo $column["food_name"]; ?> <br>
            Food Price: <?php echo $column["food_price"]; ?><br>
            Food Image:<img height="100" width="100" src="<?php echo "./images/" . $column["food_image"]; ?>" /> <br>
            <a href="./edit.php">Edit</a>
            <a href="./delete.php">Delete</a>
        </div>
    <?php } ?>

</body>

</html>