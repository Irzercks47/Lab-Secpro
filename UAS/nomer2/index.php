<?php
require "./db.php";
$res = $mysqli->query("SELECT * FROM user");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomer 2</title>
</head>

<body>
    <table border="1">
        <thead>
            <h1>User Table</h1>
        </thead>
        <tbody>
            <tr>
                <th>ID User</th>
                <th>Username</th>
                <th>Password</th>
                <th>Last Login</th>
                <th>Last Access Features</th>
                <th>Action</th>
            </tr>
            <?php

            while ($obj = $res->fetch_object()) {

            ?>
                <tr>
                    <td><?= $obj->user_id ?></td>
                    <td><?= $obj->username ?></td>
                    <td><?= $obj->password ?></td>
                    <td><?= $obj->last_login ?></td>
                    <td><?= $obj->last_access ?></td>
                    <td>
                        <a href="./userController.php?id=<?= $obj->user_id ?>&action=edit">Edit</a>
                        <a href="./userController.php?id=<?= $obj->user_id ?>action=delete">Delete</a>
                    </td>
                </tr>
            <?php

            }

            ?>
        </tbody>
    </table>
</body>

</html>