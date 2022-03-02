<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-spacing: 0;
            width: 100%;
            border: 1px solid black;
        }

        tr:nth-child(even) {
            background-color: gray;
        }
    </style>
</head>

<body>
    <?php
    include "dbconnection.php";
    $tipe_member = "SELECT * FROM customer";
    $total_transaksi = "SELECT * FROM transaksi";

    $sql = "select * from transaksi";
    $result = $conn->query($sql);

    if ($member == 'gold') {
        $diskon = (($total_transaksi * 10) / 100);
        $Total = ($total_transaksi - $diskon);
    } elseif ($member == 'silver') {
        $diskon = (($total_transaksi * 8) / 100);
        $Total = ($total_transaksi - $diskon);
        $conn->query($sql);
    } elseif ($member == 'platinum') {
        $diskon = (($total_transaksi * 5) / 100);
        $Total = ($total_transaksi - $diskon);
        $conn->query($sql);
    } elseif ($member == 'bronze') {
        $diskon = (($total_transaksi * 3) / 100);
        $Total + ($total_transaksi - $diskon);
        $conn->query($sql);
    }
    while ($columns = $result->fetch_assoc()) {
    ?>
        <table>
            <tr>
                <th>kode_transaksi</th> <?php echo $columns["kode_transaksi"] ?> <br>
                <th>Nama</th> <?php echo $columns["Nama"] ?> <br>
                <th>alamat_pengiriman</th> <?php echo $columns["alamat_pengiriman"] ?> <br>
                <th>total_transaksi</th> <?php echo $columns["total_transaksi"] ?> <br>
                <th>diskon</th> <?php echo $columns["diskon"] ?> <br>
                <th>Total</th> <?php echo $columns["Total"] ?> <br>
            </tr>
        </table>
    <?php
    }
    ?>
</body>

</html>