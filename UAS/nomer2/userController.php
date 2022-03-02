<?php
require "./db.php";

$newPassword = $_POST['newPassword'];

if ($_GET['action'] === 'edit') {
    if (!isset($newPassword)) {
        header('Location: ./edit.php?id=' . $_GET['id']);
    } else {
    }
} else if ($_GET['action'] === 'delete') {
    $deleted = array();
    $stmt = $mysqli->prepare('SELECT * FROM user WHERE user_id = ?');
    $stmt->bind_param('s', $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_object()) {
        $deleted = array(
            'user_id' => $row->user_id,
            'username' => $row->username,
            'old_password' => $row->old_password,
            'password' => $row->password,
            'last_login' => $row->last_login,
            'last_access' => $row->last_access
        );
    }
    $stmt->close();
    $stmt = $mysqli->prepare('INSERT INTO delete VALUES (?,?,?,?,?,?)');
    $stmt->bind_param(
        'ssssss',
        $deleted['user_id'],
        $deleted['username'],
        $deleted['old_password'],
        $deleted['password'],
        $deleted['last_login'],
        $deleted['last_access']
    );
    $stmt->execute();
    $stmt->close();
    $stmt = $mysqli->prepare('DELETE FROM user WHERE user_id = ?');
    $stmt->bind_param('s', $_GET['id']);
    $stmt->execute();
    $stmt->close();
    echo 'User with id' . $_GET['id'] . 'is deleted!';
} else {
    header('Location: ./index.php');
}
