<?php
include "./db.php";
$sql =
    "CREATE TABLE `transaksi` (
    `kode_transaksi` varchar(5) NOT NULL,
    `username` varchar(255) NOT NULL,
    `total_transaksi` decimal(10,0) NOT NULL,
    `diskon` int(3) NOT NULL
);

INSERT INTO `transaksi` (`kode_transaksi`, `username`, `total_transaksi`, `diskon`) VALUES
('TR001', 'Jean01', '1350000', 10),
('TR002', 'Murdock123', '14575000', 8),
('TR003', 'Bijak', '14575000', 5),
('TR004', 'Antutu', '4500000', 8),
('TR005', 'Tanturah', '7800000', 3);";

if ($conn->query($sql) === true) {
    echo "Transaction table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
