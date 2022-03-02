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
    <form action = "registerController.php" method="post">
        <input type="text" name="username" id="">
        <input type="text" name="password" id="">
        <input type="number" name="age" id="">
        <div>
            <?php
                if(isset($_POST['error'])){
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                //isset untuk mengetahui apakah sudah diisi atau tidak
                //menggunakan unset karena agar form dapat diisi kembali bila di refresh sehingga relevan 
            ?>
        </div>
        <input type="submit" value="Register">
    </form>
</body>
</html>