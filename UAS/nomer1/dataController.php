<?php
include "./db.php";
session_start();

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$templahir = $_POST['templahir'];
$tanglahir = $_POST['tanglahir'];
$nik = $_POST['nik'];
$gender = $_POST['gender'];
$married = $_POST['married'];
$npwp = $_POST['npwp'];
$kelurahan = $_POST['kelurahan'];
$kecamatan = $_POST['kecamatan'];
$kota = $_POST['kota'];
$provinsi = $_POST['provinsi'];
$salary = $_POST['salary'];
$token = $_POST['token'];


if (strlen($fname) >= 50) {
    echo "First Name must be less than 50<br>";
}

if (strlen($lname) >= 50) {
    echo "Last Name must be less than 50<br>";
}

if (strlen($templahir) >= 50) {
    echo "Tempat lahir must be less than 50<br>";
}

if (time() < strtotime('+18 years', strtotime($tanglahir))) {
    echo "Harus diatas 18 tahun<br>";
}

if (preg_match('/[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/', $nik) == 0) {
    echo 'Please enter only numbers and it have to be 16 digit<br>';
}

if (!preg_match('/[0-9][0-9].[0-9][0-9][0-9].[0-9][0-9][0-9].[0-9]-[0-9][0-9][0-9].[0-9][0-9][0-9]/', $npwp) == 0) {
    echo 'NPWP should be XX.XXX.XXX.X-XXX.XXX<br>';
}

if (strlen($kelurahan) >= 50) {
    echo "Kelurahan must be less than 50<br>";
}

if (strlen($kecamatan) >= 50) {
    echo "Kecamatan must be less than 50<br>";
}

if ((int)$salary <= 54000000 && (int)$salary >= 50000000000) {
    echo "Salary must be between 54 millions and 50 billions rupiah<br>";
}

if ($token == $_SESSION["token"]) {
    if (((int)$salary - 54000000) < 50000000) {
        $taxpercent = 5;
    } else if ((((int)$salary - 54000000) >= 50000000) || (((int)$salary - 54000000) < 250000000)) {
        $taxpercent = 15;
    } else if ((((int)$salary - 54000000) >= 250000000 || ((int)$salary - 54000000) < 500000000)) {
        $taxpercent = 25;
    } else if (((int)$salary - 54000000) >= 500000000) {
        $taxpercent = 30;
    }

    $pph = ((int)$salary - 54000000) * $taxpercent / 100;
} else {
    echo "<h1>SQL injection Detected<h1>";
}

if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed");
} else {
    $stmt = $conn->prepare("INSERT INTO pajak (fname,lname,templahir,tanglahir,nik,gender,married,npwp,kelurahan,kecamatan,kota,provinsi,salary,pph) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssssssss", $fname, $lname, $templahir, $tanglahir, $nik, $gender, $married, $npwp, $kelurahan, $kecamatan, $kota, $provinsi, $salary, $pph);
    $stmt->execute();
}
