<?php
require_once '../env.php';
require_once '../helper/database.php';
session_start();

$error = array();
if ($_POST['token'] === $_SESSION['token']) {

    // First Name
    if ($_POST['firstName'] === '') {
        $error['firstName'] = 'First Name is empty!';
    } else if (strlen($_POST['firstName']) > 50) {
        $error['firstName'] = 'First Name too long!';
    }
    // Last Name
    if ($_POST['lastName'] === '') {
        $error['lastName'] = 'Last Name is empty!';
    } else if (strlen($_POST['lastName']) > 50) {
        $error['lastName'] = 'Last Name too long!';
    }
    // Birthplace
    if ($_POST['birthplace'] === '') {
        $error['birthplace'] = 'Birthplace is empty!';
    } else if (strlen($_POST['birthplace']) > 50) {
        $error['birthplace'] = 'Birthplace too long!';
    }
    // Birthdate
    $date_compare = (int) round(
        ((strtotime(date('Y-m-d')) - strtotime($_POST['dob'])
        ) / (60 * 60 * 24
        )) / 365
    );
    if ($_POST['dob'] === '') {
        $error['dob'] = 'Birthdate is empty!';
    } else if ($date_compare < 18) {
        $error['dob'] = 'Minor detected!';
    }
    // NIK
    if ($_POST['nik'] === '') {
        $error['nik'] = 'NIK is empty!';
    } else if (preg_match('/[0-9]{16}/', $_POST['nik']) === 0) {
        $error['nik'] = 'NIK pattern not match!';
    }
    // Gender
    if ($_POST['gender'] === '') {
        $error['gender'] = 'Gender is empty!';
    }
    switch (strtolower($_POST['gender'])) {
        case 'male':
            break;
        case 'female':
            break;
        default:
            $error['status'] = 'Wrong input!';
            break;
    }
    // Married Status
    if ($_POST['status'] === '') {
        $error['status'] === 'Married Status is empty!';
    }
    switch (strtolower($_POST['status'])) {
        case 'yes':
            break;
        case 'no':
            break;
        default:
            $error['status'] = 'Wrong input!';
            break;
    }
    // NPWP
    if ($_POST['npwp'] === '') {
        $error['npwp'] = 'NPWP is empty!';
    } else if (preg_match('/[0-9]{2}.[0-9]{3}.[0-9]{3}.[0-9]{1}-[0-9]{3}.[0-9]{3}/', $_POST['npwp']) === 0) {
        $error['npwp'] = 'NPWP pattern not match!';
    }
    // Kelurahan
    if ($_POST['kelurahan'] === '') {
        $error['kelurahan'] = 'Kelurahan is empty!';
    } else if (strlen($_POST['kelurahan']) > 50) {
        $error['kelurahan'] = 'Kelurahan too long!';
    }
    // Kecamatan
    if ($_POST['kecamatan'] === '') {
        $error['kecamatan'] = 'Kecamatan is empty!';
    } else if (strlen($_POST['kecamatan']) > 50) {
        $error['kecamatan'] = 'Kecamatan too long!';
    }
    // Kota
    if ($_POST['kota'] === '') {
        $error['kota'] = 'Kota is empty!';
    }
    // Propinsi
    if ($_POST['provinsi'] === '') {
        $error['provinsi'] = 'Propinsi is empty!';
    }
    // 1 Year Salary
    if ($_POST['salary'] === '') {
        $error['salary'] = 'Salary is empty!';
    } else if ((int) $_POST['salary'] < 54000000 || (int) $_POST['salary'] > 50000000000) {
        $error['salary'] = 'Salary too low or to high';
    }
} else {

    header('HTTP/ 403');
    exit;
}

if (count($error) !== 0) {
    $_SESSION['error'] = $error;
    header('HTTP/ 200');
    header('Location: /SecProgUAS/index.php');
    exit;
}

$salary = (int) $_POST['salary'];

if ($salary < 50000000) {
    $tax = 5 / 100;
} else if ($salary >= 50000000 && $salary <= 250000000) {
    $tax = 15 / 100;
} else if ($salary >= 250000000 && $salary <= 500000000) {
    $tax = 25 / 100;
} else if ($salary > 500000000) {
    $tax = 30 / 100;
}

$pktp = 54000000;
$pkp = $salary - $pktp;
$pph = $pkp * $tax;

// Unsecure Code
$result = $mysqli->query(sprintf(
    'INSERT INTO tax(
        first_name, 
        last_name, 
        birthplace, 
        dob, 
        nik, 
        gender, 
        status, 
        npwp, 
        kelurahan, 
        kecamatan, 
        kota, 
        provinsi, 
        salary, 
        pph
        ) VALUES (
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s"
        )', $_POST['firstName'], $_POST['lastName'], $_POST['birthplace'], $_POST['dob'], $_POST['nik'],  $_POST['gender'],  $_POST['status'],  $_POST['npwp'], $_POST['kelurahan'], $_POST['kecamatan'], $_POST['kota'], $_POST['provinsi'], $_POST['salary'], $pph
));;

var_dump($result);

// Secure Code
$stmt = $mysqli->prepare('INSERT INTO tax(first_name, last_name, birthplace, dob, nik, gender, status, npwp, kelurahan, kecamatan, kota, provinsi, salary, pph) VALUES (?, ? ,? ,? , ? ,? ,? ,? ,? ,? ,? ,? ,?, ?)');
$stmt->bind_param('ssssssssssssss', $_POST['firstName'], $_POST['lastName'], $_POST['birthplace'], $_POST['dob'], $_POST['nik'], $_POST['gender'], $_POST['status'], $_POST['npwp'], $_POST['kelurahan'], $_POST['kecamatan'], $_POST['kota'], $_POST['provinsi'], $_POST['salary'], $pph);
$stmt->execute();