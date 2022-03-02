<?php

require "./db.php";

$newPass = $_POST['newPass'];
$currPass = $_POST['currPass'];
$verifPass = $_POST['verifPass'];

session_start();
if ($_GET['action'] === 'edit') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $mysqli->prepare('SELECT * FROM user WHERE user_id = ?');
        $stmt->bind_param('s', $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($obj = $result->fetch_object()) {
            $oldPass = $obj->Password;
        }

        $error = array();

        if ($currPass !== $oldPass) {
            $error['currPass'] = 'Current password is not correct!';
        }
        if ($newPass !== $verifPass) {
            if (!is_array($error['newPass']))
                $error['newPass'] = array();
            array_push($error['newPass'], 'Password does not match');
        }

        if (preg_match('/^(?=.{10,})(?=.[a-z])(?=.[A-Z])(?=.[@#$%^&+!=]).*$/', $newPass) !== 1) {
            if (!is_array($error['newPass']))
                $error['newPass'] = array();
            array_push($error['newPass'], 'Password doesnt contain one uppercase, one lowercase, or one special character; ' .
                $newPass);
        }
        if (count($error) !== 0) {
            $_SESSION['error'] = $error;
            header('HTTP/ 400');
            header('Location: /uas-no-2/editUser.php?id=' . $_GET['id']);
            exit;
        }
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $password = md5($newPass . substr(str_shuffle($chars), 0, 10));
        $stmt = $mysqli->prepare('UPDATE user SET old_password = ?, password = ? WHERE user_id = ?');
        $stmt->bind_param('sss', $oldPass, $password, $_GET['id']);
        $stmt->execute();
        $stmt->close();
        header('Location: ./index.php');
    } else {
        header('Location: ./edit.php?id=' . $_GET['id']);
    }
}
