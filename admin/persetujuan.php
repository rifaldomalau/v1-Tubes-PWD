<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
include('../config/koneksi.php');

// PROSES PERSETUJUAN (Approve/Reject)
if(isset($_GET['aksi']) && isset($_GET['id'])){
    $aksi = $_GET['aksi'];
    $id_izin = $_GET['id'];

    $data_izin = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pengajuan_izin WHERE id='$id_izin'"));
    $user_id = $data_izin['user_id'];
    $tanggal = $data_izin['tanggal'];
    $alasan  = $data_izin['jenis'] . ": " . $data_izin['keterangan'];

    if($aksi == 'terima'){
        mysqli_query($koneksi, "UPDATE pengajuan_izin SET status='Disetujui' WHERE id='$id_izin'");
        mysqli_query($koneksi, "
            INSERT INTO absensi (user_id, tanggal, jam_masuk, lokasi_lat, lokasi_long) 
            VALUES ('$user_id', '$tanggal', '00:00:00', '-', '$alasan')
        ");
        echo "<script>alert('Pengajuan DISETUJUI! Data otomatis masuk ke absensi.'); window.location='persetujuan.php';</script>";
    } 
    elseif($aksi == 'tolak'){
        mysqli_query($koneksi, "UPDATE pengajuan_izin SET status='Ditolak' WHERE id='$id_izin'");
        echo "<script>alert('Pengajuan DITOLAK.'); window.location='persetujuan.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="css/persetujuan.css">
    <title>Persetujuan Izin</title>
</head>
<body>

<div class="layout-wrapper">
    <?php $page = 'persetujuan'; include('sidebar.php'); ?>

    <div class="content-area">
        <h2 class="title-page">Persetujuan Izin Pegawai</h2>

        <div class="card card-approval">
            <div class="card-body">
                <table class="approval-table">
                    <thead class="table-header">
                        <tr>
                            <th>Pegawai</th>
                            <th>Tanggal Izin</th>
                            <th>Alasan & Bukti</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT pengajuan_izin.*, users.nama_lengkap 
                                  FROM pengajuan_izin 
                                  JOIN users ON pengajuan_izin.user_id = users.id 
                                  ORDER BY CASE WHEN status = 'Pending' THEN 1 ELSE 2 END, created_at DESC";
                        
                        $result = mysqli_query($koneksi, $query);

                        while($row = mysqli_fetch_assoc($result)){
                            $statusClass = strtolower($row['status']);
                            $statusClass = $statusClass == "pending" ? "status-pending" : ($statusClass == "disetujui" ? "status-diterima" : "status-ditolak");
                        ?>
                        <tr class="table-row">
                            <td class="col-pegawai"><?php echo $row['nama_lengkap']; ?></td>

                            <td class="col-tanggal">
                                <?php echo date('d M Y', strtotime($row['tanggal'])); ?>
                            </td>

                            <td class="col-alasan">
                                <strong><?php echo $row['jenis']; ?></strong><br>
                                <small><?php echo $row['keterangan']; ?></small>
                                <?php if($row['bukti_foto']){ ?>
                                    <br><a class="link-bukti" href="../assets/img/<?php echo $row['bukti_foto']; ?>" target="_blank">Lihat Bukti</a>
                                <?php } ?>
                            </td>

                            <td class="col-status <?php echo $statusClass; ?>">
                                <?php echo $row['status']; ?>
                            </td>

                            <td class="col-aksi">
                                <?php if($row['status'] == 'Pending'){ ?>
                                    <a class="btn-approve" href="persetujuan.php?aksi=terima&id=<?php echo $row['id']; ?>" onclick="return confirm('Setujui izin ini?')">Terima</a>
                                    <a class="btn-reject" href="persetujuan.php?aksi=tolak&id=<?php echo $row['id']; ?>" onclick="return confirm('Tolak izin ini?')">Tolak</a>
                                <?php } else { ?>
                                    <small class="info-proses">Sudah diproses</small>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
