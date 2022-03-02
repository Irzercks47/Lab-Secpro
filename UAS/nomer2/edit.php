<?php
session_start();
if (isset($_SESSION['error'])) {
    echo '<pre>';
    var_dump($_SESSION['error']);
    echo '</pre>';
}
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nomer 2</title>
</head>

<body>
    <h1>Change Password</h1>
    <form action="./editController.php?id=<?= $_GET['id'] ?>&action=edit" method="post">
        <div>
            <label for="currPass">Current Password*</label>
            <input type="password" name="currPass" id="currPass" required>
        </div>
        <div>
            <label for="newPassword">New Password*</label>
            <input type="password" name="newPass" id="newPass" required>
        </div>
        <div>
            <label for="verifPass">Verify New Password*</label>
            <input type="password" name="verifPass" id="verifPass" required>
        </div>
        <button type="submit">Change Password</button>
    </form>
</body>

</html>