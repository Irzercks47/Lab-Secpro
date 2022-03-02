<?php
    include "pert2b.php";
    require "pert2b.php";
    //beda include dan require adalah bila nama file salah maka require tidak akan menampilkan code selanjutnya sedangkan include menampilkan
    //require_once kalau sudah muncul tidak akan muncul bila sudah ditaruh diatas maka bila ditaruh dibawah tidak akan muncul
    echo "dari pert2";
    echo "<br>";

    echo date("Y-m-d");//case sensitive
    $tulisan = "Halo, lalalalalala";
    echo "<br>";

    //strlen fungsi sama seperti biasa
    echo strlen($tulisan);
    echo"<br>";
    //lower semua huruf di string
    echo strtolower($tulisan);
    echo"<br>";
    //uppercase huruf di string
    echo strtoupper($tulisan);
    echo"<br>";
    //untuk reverse string
    echo strrev($tulisan);
    echo"<br>";
    //uppercase words untuk kapitallisasi semua kata / huruf awal
    echo ucwords($tulisan);
    echo"<br>";
    //trim untuk menghilangkan whitespace(spasi, \t, dll) di depan dan akhir tulisan
    var_dump(" aa bb ");
    echo"<br>";
    var_dump(trim(" aa bb "));
    echo"<br>";
    //substring mengambil beberapa string dari string lain bila tidak mengisi parameter kedua akan mengambil sisa
    echo substr($tulisan, 0, 4);
    echo"<br>";
    //explode pisahkan string jadi array
    $hasil_explode= explode(" ", $tulisan);
    var_dump($hasil_explode);
    echo"<br>";
    //implode untuk gabungkan array menjadi string
    echo implode("#", $hasil_explode);
    echo"<br>";
    //empty untuk cek bila string nya kosong
    var_dump(empty(" "));
    echo"<br>";
    //strcmp untuk komparasi string
    echo strcmp("abc", "abc");
    echo"<br>";
    echo strcmp("abc", "ab");
    echo"<br>";
    echo strcmp("ab", "abc");
    echo"<br>";
    //strcasecmp untuk komparasi string secara case insensitive
    echo strcasecmp("ABC", "abc");
    echo"<br>";
    //str_word_count untuk hitung jumlah kata
    echo str_word_count($tulisan);
    echo"<br>";
    //strpos (string position) untuk cari tau posisi string
    echo strpos($tulisan, "Halo");
    echo "<br>";
    var_dump(strpos($tulisan, "x"));
    echo "<br>";
    //printf untuk print format
    printf("Halo %s", "Irza");
    echo "<br>";
    function sayHello(){
        echo "hello";
    }

    sayHello();

    function add($a = 1, $b = 4){
        $hasil = $a + $b;
        return $hasil;
    }//di php bisa memberi default parameter value

    echo add(2, 4);
    echo"<br>";

    function increment($value){
        $value ++;
    }// harus diberi (&) di parameter agar parameter bisa menggunakan semua variabel bila memanggil fungsi 

    $angka = 2;
    increment($angka);
    echo($angka);
    echo "<br>";

    $angka2= 5;
    function decrement(){
        global $angka2;
        $angka2 --;
    }

    decrement();
    echo($angka2);
    echo"<br>";

?>