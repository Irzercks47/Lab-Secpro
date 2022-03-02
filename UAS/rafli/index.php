<?php

require_once './env.php';
require_once './helper/csrf.php';
session_start();
if (isset($_SESSION['error']))
    echo '<pre>';
    var_dump($_SESSION['error']);
    echo '</pre>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaxApp</title>
</head>

<body>
    <h1>Tax Validation</h1>
    <form action="./controller/taxController.php" method="post" enctype="application/x-www-form-urlencoded">
        <input type="text" name="firstName" id="firstName" placeholder="First Name">
        <input type="text" name="lastName" id="lastName" placeholder="Last Name">
        <input type="text" name="birthplace" id="birthplace" placeholder="Birthplace">
        <input type="date" name="dob" id="dob">
        <input type="text" name="nik" id="nik" placeholder="NIK">
        <div>
            <label for="gender">Gender</label>
            <input type="radio" name="gender" id="gender" value="" hidden checked>
            <input type="radio" name="gender" id="gender" value="male"> Male
            <input type="radio" name="gender" id="gender" value="female"> Female
        </div>
        <div>
            <label for="status">Married</label>
            <input type="radio" name="status" id="status" value="" hidden checked>
            <input type="radio" name="status" id="status" value="yes"> Yes
            <input type="radio" name="status" id="status" value="no"> No
        </div>
        <input type="text" name="npwp" id="npwp" placeholder="NPWP">
        <input type="text" name="kelurahan" id="kelurahan" placeholder="Kelurahan">
        <input type="text" name="kecamatan" id="kecamatan" placeholder="Kecamatan">
        <select name="kota" id="kota">
            <option value="" hidden selected>Pilih kota</option>
            <option value="malang">Malang</option>
        </select>
        <select name="provinsi" id="provinsi">
            <option value="" hidden selected>Pilih provinsi</option>
            <option value="malang">Jawa Timur</option>
        </select>
        <input type="text" name="salary" id="salary">
        <input type="hidden" name="token" value="<?= generate_token(); ?>">
        <button type="submit">Submit</button>
    </form>
    <script>
        // Debug
        document.querySelector('form').addEventListener('change', (e) => {
            console.clear()
            console.log(e.target.name, e.target.value)
        })
    </script>
</body>

</html>