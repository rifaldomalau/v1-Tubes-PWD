<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
include('../config/koneksi.php');

if(isset($_POST['simpan_tugas'])){
    $user_id = $_POST['user_id']; 
    $judul   = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $deadline = $_POST['deadline'];

    if($user_id == 'all'){
        $ambil_staff = mysqli_query($koneksi, "SELECT id FROM users WHERE role='staff' AND is_active=1");
        while($staff = mysqli_fetch_assoc($ambil_staff)){
            $id_staff = $staff['id'];
            mysqli_query($koneksi, "INSERT INTO tugas (user_id, judul, deskripsi, deadline) 
                                    VALUES ('$id_staff', '$judul', '$deskripsi', '$deadline')");
        }
        echo "<script>alert('Berhasil! Tugas dikirim ke SEMUA STAFF.'); window.location='tugas.php';</script>";
    } else {
        $simpan = mysqli_query($koneksi, "INSERT INTO tugas (user_id, judul, deskripsi, deadline) 
                                         VALUES ('$user_id', '$judul', '$deskripsi', '$deadline')");
        if($simpan){
            echo "<script>alert('Tugas berhasil diberikan!'); window.location='tugas.php';</script>";
        }
    }
}

if(isset($_GET['hapus'])){
    $id_tugas = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM tugas WHERE id='$id_tugas'");
    echo "<script>alert('Tugas dihapus!'); window.location='tugas.php';</script>";
}

$data_staff = mysqli_query($koneksi, "SELECT * FROM users WHERE role='staff' AND is_active=1");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Tugas - Admin</title>
    <link rel="stylesheet" href="css/tugas.css">
</head>
<body>

<div class="layout">

    <?php 
    $page = 'tugas'; 
    include('sidebar.php'); 
    ?>

    <div class="content">

        <h3 class="title">Manajemen Tugas Pegawai</h3>

        <div class="card">
            <div class="card-header">Buat Tugas Baru</div>

            <div class="card-body">
                <form method="POST" class="task-form">

                    <div class="form-group">
                        <label>Pilih Pegawai</label>
                        <select name="user_id" required>
                            <option value="">-- Pilih Staff --</option>
                            <option value="all">SEMUA STAFF</option>

                            <?php while($staff = mysqli_fetch_assoc($data_staff)){ ?>
                                <option value="<?php echo $staff['id']; ?>">
                                    <?php echo $staff['nama_lengkap']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Judul Tugas</label>
                        <input type="text" name="judul" required placeholder="Contoh: Rapat Evaluasi">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" rows="3" placeholder="Detail tugas..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Deadline</label>
                        <input type="date" name="deadline" required>
                    </div>

                    <button type="submit" name="simpan_tugas" class="btn-submit">Kirim Tugas</button>

                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Daftar Semua Tugas</div>

            <div class="card-body">
                <table class="task-table">
                    <thead>
                        <tr>
                            <th>Pegawai</th>
                            <th>Tugas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $query = "SELECT tugas.*, users.nama_lengkap 
                                  FROM tugas 
                                  JOIN users ON tugas.user_id = users.id 
                                  ORDER BY tugas.id DESC";
                        $result = mysqli_query($koneksi, $query);

                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?php echo $row['nama_lengkap']; ?></td>
                            <td>
                                <strong><?php echo $row['judul']; ?></strong><br>
                                Deadline: <?php echo date('d/m/Y', strtotime($row['deadline'])); ?>
                            </td>
                            <td class="<?php echo strtolower($row['status']); ?>">
                                <?php echo $row['status']; ?>
                            </td>
                            <td>
                                <a class="btn-edit" href="tugas-edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a class="btn-delete" href="tugas.php?hapus=<?php echo $row['id']; ?>" 
                                   onclick="return confirm('Hapus tugas ini?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='4' class='empty'>Belum ada tugas.</td></tr>";
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
