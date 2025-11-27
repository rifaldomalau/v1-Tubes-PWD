<?php
session_start();
include('../config/koneksi.php');
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Absensi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #fafafa; }
        .badge { padding: 3px 6px; background-color: #17a2b8; color: white; border-radius: 4px; }
    </style>
</head>
<body>

<?php $page = 'riwayat'; include('sidebar.php'); ?>

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
        while($r = mysqli_fetch_assoc($q)){
            echo "<tr>
                    <td>".date('d M Y', strtotime($r['tanggal']))."</td>
                    <td><span class='badge'>".$r['jam_masuk']."</span></td>
                    <td>".$r['lokasi_lat'].", ".$r['lokasi_long']."</td>
                  </tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
