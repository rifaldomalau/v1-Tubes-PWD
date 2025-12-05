<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: ../auth/login.php");
    exit;
}
include('../config/koneksi.php');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Absen</title>
    <link rel="stylesheet" href="css/riwayat.css">
</head>
<body>

<div class="layout">

    <?php $page = 'riwayat'; include('sidebar.php'); ?>

    <div class="content">

        <h2>Riwayat Absensi Saya</h2>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Lokasi</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $id = $_SESSION['user_id'];
                $q = mysqli_query($koneksi, "SELECT * FROM absensi WHERE user_id='$id' ORDER BY tanggal DESC");

                while($d = mysqli_fetch_assoc($q)){
                    echo "
                    <tr>
                        <td>{$d['tanggal']}</td>
                        <td>{$d['jam_masuk']}</td>
                        <td>{$d['lokasi']}</td>
                    </tr>";
                }
            ?>
            </tbody>
        </table>

    </div>

</div>

</body>
</html>
