<?php
require_once './env.php';
require_once './helper/database.php';

if ($_GET['action'] === 'edit') {
    if (!isset($_POST['newPassword'])) {
        header('Location: /SecProgUAS/edit_user.php?id=' . $_GET['id']);
    } else {
        
    }
} else if ($_GET['action'] === 'delete') {
    $deleted = array();
    // Get the data
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
    // Insert to userDeleted table
    $stmt = $mysqli->prepare('INSERT INTO userdeleted VALUES (?,?,?,?,?,?)');
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
    // Delete data from user table
    $stmt = $mysqli->prepare('DELETE FROM user WHERE user_id = ?');
    $stmt->bind_param('s', $_GET['id']);
    $stmt->execute();
    $stmt->close();
    echo 'User with id' . $_GET['id'] . 'is successfully deleted!';
} else {
    header('Location: /SecProgUAS/user.php');
}
