<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: ../auth/login.php");
    exit;
}
include('../config/koneksi.php');

$user_id = $_SESSION['user_id'];
$hari_ini = date('Y-m-d');

// Cek apakah hari ini sudah absen?
$cek_absen = mysqli_query($koneksi, "SELECT * FROM absensi WHERE user_id = '$user_id' AND tanggal = '$hari_ini'");
$sudah_absen = mysqli_num_rows($cek_absen);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Staff</title>
</head>
<body>

<?php 
$page = 'dashboard'; 
include('sidebar.php'); 
?>

<h2>Dashboard Pegawai</h2>

<div>
    <div>
        <h3>Form Absensi Harian</h3>
        <h1 id="jam-digital">--:--:--</h1>
        <p><?php echo date('l, d F Y'); ?></p>
        <hr>

        <?php if ($sudah_absen > 0) { ?>
            <div>
                <h4>✅ Anda sudah absen hari ini!</h4>
                <p>Terima kasih, selamat bekerja.</p>
            </div>
        <?php } else { ?>
            
            <form action="absen-proses.php" method="POST">
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

                <div id="lokasi-info">
                    Sedang mendeteksi lokasi...
                </div>

                <button type="submit" name="absen_masuk" id="btn-absen" disabled>
                    📍 KLIK UNTUK ABSEN MASUK
                </button>
            </form>

        <?php } ?>
    </div>

    <div>
        <h5>Status Akun</h5>
        <h3>Aktif ✅</h3>
    </div>
</div>

<!-- panggil index js nya -->

</body>
</html>
