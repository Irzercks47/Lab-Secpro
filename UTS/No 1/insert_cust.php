<?php
include "./db.php";

$sql =
    "CREATE TABLE `customer` (
    `username` varchar(255) NOT NULL,
    `Nama` varchar(255) NOT NULL,
    `tipe_member` varchar(8) NOT NULL,
    `no_handphone` int(10) NOT NULL,
    `alamat_pengiriman` varchar(15) NOT NULL
);

INSERT INTO `customer` (`username`, `Nama`, `tipe_member`, `no_handphone`, `alamat_pengiriman`) VALUES
('Jean01', 'Andi', 'gold', 754632463, 'jl. Anggrek 01'),
('Murdock123', 'Budi', 'silver', 845535635, 'jl. Melati 02'),
('Bijak', 'Ani', 'platinum', 345465778, 'jl. Tentram 05'),
('Antutu', 'Nita', 'silver', 645646456, 'jl. Tantular 06'),
('Tanturah', 'Jaja', 'bronze', 765545356, 'jl. Tango 04');";

if ($conn->query($sql) === true) {
    echo "Customer table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
