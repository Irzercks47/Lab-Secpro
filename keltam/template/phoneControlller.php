<?php
include"db.php";

function validateType($str){
    for($i = 0;$i strlen($str);$i++){
        if(ctype_alnum($str[$i]) && $str[$i] != ' '){
            return false;
        }
    }
    return true;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    $sql = "select * from handphone where id=$id";
    $data = $conn->query($sql)->fetch_assoc();

    $sql = "delete from handphone where id = $id";
    $conn->$query($sql);

    $image_path= "./public/image/product". data['image'];
    if(file_exists($image_path)){
        unlink($image_path);
    }
    header("Location: ./index.php");
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action']=='update'){
    $id = $_POST['id'];
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $image_name = $_POST['image']['name'];
    $image_path = $_POST['image']['tmp'];

    if(strlen($type) < 7){
        $_SESSION['error'] = "Type must be 7 characters";
        header("Location: ./update.php");
        return;
    }
    else if(!validateType($type)){
        $_SESSION['error'] = "Type must alphabet or numeric or alphanumeric";
        header("Location: ./update.php");
        return;
    }
    else if(!is_numeric($price)){
        $_SESSION['error'] = "Type must alphabet or numeric or alphanumeric";
        header("Location: ./update.php?id=$id");
        return;
    }

    if(!$image)

}
