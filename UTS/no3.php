<?
include "./db.php";
$getUser = $_REQUEST["username"];
$getId = $_REQUEST["id"];
if (!empty($getUser)) {
    $user = "select * from pengguna where username = '" . $getUser
        . "'";
    $hasil = $conn->query($user);
} elseif (!empty($getId)) {
    $id = "select * from pengguna where id = " . $getId;
    $hasil = $conn->query($id);
}

$result = "SELECT * FROM pengguna";

if (!$hasil) {
    echo "User tidak ketemu: " . $_GET["username"];
} else {
    while ($row = $result->fetch_array()) {
        echo "User Ketemu: <br>";
        echo "<b>Id:</b> " . $row[0] . "<br>";
        echo "<b>Username: </b>" . $row[1] . "<br>";
        echo "<b>Password: </b>" . $row[2] . "<br>";
        echo "<b>Firstname: </b>" . $row[3] . "<br>";
        echo "<b>Lastname: </b>" . $row[4] . "<br>";
        echo "<b>Email: </b>" . $row[5] . "<br>";
    }
}
