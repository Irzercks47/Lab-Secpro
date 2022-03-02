<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomer 1</title>
    <style>
        form label {
            margin-top: 10px;
            display: block;
        }

        .container {
            display: flex;
            justify-content: center;
        }

        form {
            width: 200px;
            margin-top: 40px;
        }

        label .ib {
            display: inline-block;
        }

        label input {
            display: inline;
        }

        button {
            margin-top: 20px;
        }

        .alert {
            color: red;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <?php
    include './getipaddress.php';
    function csrf_token()
    {
        if (!isset($_SESSION["token"])) {
            $_SESSION['last_access'] = date("Y-m-d");
            $_SESSION['time'] = time();
            $_SESSION['ip_address'] = get_ip_address();
            $_SESSION["token"] = md5($_SESSION['last_access'] + $_SESSION['time'] + $_SESSION['ip_address']);
        }
        return $_SESSION["token"];
    }
    ?>
    <div class="container">
        <form action="./dataController.php" method="post">
            <label for="fname">First name:</label>
            <input type="text" id="fname" name="fname" required>
            <label for="lname">Last name:</label>
            <input type="text" id="lname" name="lname" required>
            <label for="templahir">Birthplace:</label>
            <input type="text" id="templahir" name="templahir" required>
            <label for="tanglahir">Birthdate:</label>
            <input type="date" id="tanglahir" name="tanglahir" required>
            <label for="nik">NIK KTP:</label>
            <input type="text" id="nik" name="nik" required>
            <label>Gender:
                <input type="radio" id="male" name="gender" value="male" required>
                <label class="ib" for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female" required>
                <label class="ib" for="female">Female</label>
            </label>
            <label>Married:
                <input type="radio" id="yes" name="married" value="yes" required>
                <label class="ib" for="yes">Yes</label>
                <input type="radio" id="no" name="married" value="no" required>
                <label class="ib" for="no">No</label>
            </label>
            <label for="npwp">NPWP:</label>
            <input type="text" id="npwp" name="npwp" required>
            <label for="kelurahan">Kelurahan</label>
            <input type="text" id="kelurahan" name="kelurahan" required>
            <label for="kecamatan">Kecamatan</label>
            <input type="text" id="kecamatan" name="kecamatan" required>
            <label for="kota">Kota:</label>
            <select name="kota" id="kota">
                <option value="surabaya">Surabaya</option>
                <option value="bandung">Bandung</option>
                <option value="jakarta">Jakarta</option>
                <option value="yogyakarta">Yogyakarta</option>
                <option value="semarang">Semarang</option>
            </select>
            <label for="provinsi">Provinsi:</label>
            <select name="provinsi" id="provinsi">
                <option value="jatim">Jawa Timur</option>
                <option value="jabar">Jawa Barat</option>
                <option value="jakarta">Jakarta</option>
                <option value="diy">DIY</option>
                <option value="jateng">Jawa Tengah</option>
            </select>
            <label for="salary">1 year salary</label>
            <input type="text" id="salary" name="salary" required>
            <button type="submit">Submit</button>
            <input type="hidden" name="token" value="<?php echo csrf_token(); ?>">
        </form>
    </div>
</body>

</html>