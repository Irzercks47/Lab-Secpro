<?php

include "./connection.php";
$name = $_POST["name"];
$price = $_POST["price"];

$image_file = $_FILES["image"];
// untuk mengetahui nama dan extension file
$extension = pathinfo($image_file["name"], PATHINFO_EXTENSION);
if ($extension != "jpg" && $extension != "png") {
    echo "Extension can only be jpg or png";
    return;
}

// batas size filenya 1 mb
if ($image_file["size"] > 1000000) {
    echo "Maximum size is 1 mb";
}

$target = "./images/" . $image_file["name"];
move_uploaded_file($image_file["tmp_name"], $target);

$imageName = $image_file["name"];
//ini tidak aman
//karena sqlinjection dengan cara bikin query dibawah
// $query = "
// insert into foods(food_name, food_price, food_image)
// values('$name','$price', '$imageName')
// ";

// $conn->query($query);

//kalau mau aman pakai prepared statement
$statement = $conn->prepare("
    insert into foods(food_name, food_price, food_image)
    values(?,?,?)
");

$statement->bind_param("sis", $name, $price, $imageName);
$statement->execute();
// //redirect halaman
header("Location: ./index.php");
