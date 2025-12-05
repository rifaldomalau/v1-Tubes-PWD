<?php
session_start();
// Cek Login & Role Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
include('../config/koneksi.php');

// Data untuk Tabel Absensi Dashboard
$query = "SELECT absensi.*, users.nama_lengkap 
          FROM absensi 
          JOIN users ON absensi.user_id = users.id 
          ORDER BY absensi.tanggal DESC, absensi.jam_masuk DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - E-Staff</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

<div class="layout-wrapper">

    <?php 
    $page = 'dashboard'; 
    include('sidebar.php'); 
    ?>

    <div class="content fade-in">

        <div class="dashboard-header fade-in">
            <h2>Dashboard Absensi</h2>
            <span>Halo, <?php echo $_SESSION['nama']; ?></span>
        </div>

        <div class="section-box fade-in">
            <div class="section-header">
                <h5>Aktivitas Absensi Terbaru</h5>
                <a href="cetak-laporan.php" target="_blank">🖨️ Cetak PDF</a>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Pegawai</th>
                            <th>Jam Masuk</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $no = 1;
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)) { 
                        ?>
                        <tr class="fade-in">
                            <td><?= $no++; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                            <td><?= $row['nama_lengkap']; ?></td>
                            <td><span><?= $row['jam_masuk']; ?></span></td>

                            <td>
                                <small><?= $row['lokasi_lat']; ?>,<br><?= $row['lokasi_long']; ?></small>
                            </td>

                            <td>
                                <a href="https://www.google.com/maps/search/?api=1&query=<?= $row['lokasi_lat'].','.$row['lokasi_long']; ?>" target="_blank">
                                    Lihat Peta
                                </a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='6'>Belum ada data absensi.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

</body>
</html>
