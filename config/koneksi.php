<?php
$server   = "localhost:3307"; // laptopku portnya bentrok, jadi kukasih 3307. kalian hapus aja 3307 kalau tidak bentrok
$username = "root";           
$password = "";               
$database = "db_pegawai";     

$koneksi = mysqli_connect($server, $username, $password, $database);

if (!$koneksi) {
    die("Gagal terkoneksi: " . mysqli_connect_error());
}
?>