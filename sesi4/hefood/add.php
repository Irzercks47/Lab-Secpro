<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Food</title>
</head>

<body>
    <h1>Add New Item</h1>
    <a href="./index.php">Back to index</a>
    <hr>
    <!-- kalau tidak pakai enctype="multipart/form-data" tidak bisa upload file -->
    <form action="./insert.php" method="post" enctype="multipart/form-data">
        <label>Name: </label>
        <input type="text" name="name">
        <br>
        <label>Price: </label>
        <input type="number" name="price">
        <br>
        <label>Image: </label>
        <input type="file" name="image">
        <br>
        <button>Insert</button>
    </form>
</body>

</html>