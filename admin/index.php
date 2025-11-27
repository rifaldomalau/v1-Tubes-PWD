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
    
    <link rel="stylesheet" href="index.css"> 
</head>
<body>

<div>
    
    <?php 
    
    $page = 'dashboard'; 
    include('sidebar.php'); 
    ?>

    <div>
        
        <div>
            <h2>Dashboard Absensi</h2>
            <span>Halo, <?php echo $_SESSION['nama']; ?></span>
        </div>

        <div>
            <div>
                <h5 class="mb-0">Aktivitas Absensi Terbaru</h5>
                <a href="cetak-laporan.php" target="_blank">🖨️ Cetak PDF</a>
            </div>
            <div>
                <div>
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
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                <td><?php echo $row['nama_lengkap']; ?></td>
                                <td><span><?php echo $row['jam_masuk']; ?></span></td>
                                <td>
                                    <small><?php echo $row['lokasi_lat']; ?>,<br><?php echo $row['lokasi_long']; ?></small>
                                </td>
                                <td>
                                    <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $row['lokasi_lat'].','.$row['lokasi_long']; ?>" target="_blank">Lihat Peta</a>
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
</div>

</body>
</html>