<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="loginController.php" method="post">
        <input type="text" name="username" id="">
        <input type="text" name="password" id="">
        <input type="checkbox" name="remember">
        <input type="submit" value="Submit">
    </form>
</body>

</html>