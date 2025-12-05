<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: ../auth/login.php");
    exit;
}
include('../config/koneksi.php');
$id_user = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengajuan Izin</title>

    <link rel="stylesheet" href="css/izin.css">
</head>
<body>

<div class="layout">

    <?php $page = 'izin'; include('sidebar.php'); ?>

    <div class="content-area">

        <h2>Pengajuan Izin / Sakit</h2>

        <div class="form-container">
            <h3>Buat Pengajuan Baru</h3>

            <form action="izin-proses.php" method="POST" enctype="multipart/form-data">
                
                <div>
                    <label>Tanggal Tidak Hadir</label>
                    <input type="date" name="tanggal" required>
                </div>

                <div>
                    <label>Jenis Izin</label>
                    <select name="jenis">
                        <option value="Sakit">Sakit (Lampirkan Surat)</option>
                        <option value="Izin">Izin Keperluan Lain</option>
                    </select>
                </div>

                <div>
                    <label>Keterangan / Alasan</label>
                    <textarea name="keterangan" rows="3" required></textarea>
                </div>

                <div>
                    <label>Bukti Foto (Opsional)</label>
                    <input type="file" name="bukti" accept=".jpg,.jpeg,.png">
                    <small>Opsional. Max 2MB.</small>
                </div>

                <div>
                    <button type="submit" name="ajukan">Kirim Pengajuan</button>
                </div>

            </form>
        </div>

        <div class="riwayat-container">
            <h3>Riwayat Pengajuan Saya</h3>

            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Ket. & Bukti</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM pengajuan_izin WHERE user_id='$id_user' ORDER BY created_at DESC");
                    while($row = mysqli_fetch_assoc($query)){
                    ?>
                    <tr>
                        <td><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                        <td><?php echo $row['jenis']; ?></td>
                        <td>
                            <?php echo $row['keterangan']; ?>
                            <?php if($row['bukti_foto']){ ?>
                                <br><a href="../assets/img/<?php echo $row['bukti_foto']; ?>" target="_blank">Lihat Bukti</a>
                            <?php } ?>
                        </td>
                        <td class="status-<?php echo strtolower($row['status']); ?>">
                            <?php echo $row['status']; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>

    </div>

</div>

</body>
</html>
