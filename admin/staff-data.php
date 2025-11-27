<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
include('../config/koneksi.php');

// Fitur Hapus Pegawai
if(isset($_GET['hapus'])){
    $id_staff = $_GET['hapus'];
    $hapus = mysqli_query($koneksi, "DELETE FROM users WHERE id='$id_staff'");
    if($hapus){
        echo "<script>alert('Pegawai berhasil dihapus!'); window.location='staff-data.php';</script>";
    }
}

// Pencarian
$keyword = "";
if(isset($_GET['cari'])){
    $keyword = mysqli_real_escape_string($koneksi, $_GET['cari']);
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE role='staff' AND (nama_lengkap LIKE '%$keyword%' OR username LIKE '%$keyword%' OR email LIKE '%$keyword%') ORDER BY created_at DESC");
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE role='staff' ORDER BY created_at DESC");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pegawai - E-Staff</title>
</head>
<body>

<div>

    <?php 
    $page = 'staff'; 
    include('sidebar.php'); 
    ?>

    <div>
        <h2>Manajemen Data Pegawai</h2>

        <div>
            <div>
                <div>
                    <div>
                        <h5>Daftar Pegawai Terdaftar</h5>
                    </div>
                    <div>
                        <form action="" method="GET">
                            <div>
                                <input type="text" name="cari" placeholder="Cari nama, username, atau email..." value="<?php echo $keyword; ?>" required>
                                <button type="submit">Cari</button>
                                <?php if(isset($_GET['cari'])){ ?>
                                    <a href="staff-data.php">Reset</a>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama & Username</th>
                            <th>Email</th>
                            <th>Status Akun</th>
                            <th>Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(mysqli_num_rows($query) > 0) {
                            while($row = mysqli_fetch_assoc($query)){ 
                        ?>
                        <tr>
                            <td>
                                <?php 
                                    $foto = $row['foto_profil'];
                                    if($foto == "" || !file_exists("../assets/img/$foto")){ $foto = "default.png"; }
                                ?>
                                <img src="../assets/img/<?php echo $foto; ?>" width="50" height="50">
                            </td>
                            <td>
                                <strong><?php echo $row['nama_lengkap']; ?></strong><br>
                                @<?php echo $row['username']; ?>
                            </td>
                            <td><?php echo $row['email']; ?></td>
                            <td>
                                <?php if($row['is_active'] == 1){ ?>
                                    Aktif
                                <?php } else { ?>
                                    Belum Aktivasi
                                <?php } ?>
                            </td>
                            <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                            <td>
                                <a href="staff-data.php?hapus=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus pegawai ini? Semua data tugas & absensinya akan hilang permanen!')">Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            } 
                        } else {
                            echo "<tr><td colspan='6'>
                                    <h5>Data tidak ditemukan.</h5>
                                    <p>Coba kata kunci lain.</p>
                                  </td></tr>";
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
