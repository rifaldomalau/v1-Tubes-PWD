<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: ../auth/login.php");
    exit;
}
include('../config/koneksi.php');

$id = $_SESSION['user_id'];
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
</head>
<body>

<?php $page = 'profil'; include('sidebar.php'); ?>

<h2>Edit Profil Saya</h2>

<?php 
if(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses') {
    echo "<p style='color:green;'>Profil berhasil diperbarui!</p>";
} elseif(isset($_GET['pesan']) && $_GET['pesan'] == 'gagal') {
    echo "<p style='color:red;'>Gagal update profil. Cek tipe file gambar.</p>";
}
?>

<form action="profil-proses.php" method="POST" enctype="multipart/form-data">

    <?php 
    $foto = $data['foto_profil'];
    if($foto == "" || !file_exists("../assets/img/$foto")){ $foto = "default.png"; }
    ?>
    <div>
        <img src="../assets/img/<?php echo $foto; ?>" alt="Foto Profil" style="width:150px;height:150px;object-fit:cover;border-radius:50%;">
    </div>

    <div>
        <label>Ganti Foto Profil</label><br>
        <input type="file" name="foto" accept=".jpg,.jpeg,.png">
        <small>Format: JPG, JPEG, PNG (Max 2MB)</small>
    </div>

    <div>
        <label>Nama Lengkap</label><br>
        <input type="text" name="nama" value="<?php echo $data['nama_lengkap']; ?>" required>
    </div>

    <div>
        <label>Username</label><br>
        <input type="text" value="<?php echo $data['username']; ?>" readonly>
    </div>

    <div>
        <label>Email</label><br>
        <input type="email" value="<?php echo $data['email']; ?>" readonly>
    </div>

    <div>
        <button type="submit" name="update">Simpan Perubahan</button>
    </div>

</form>

</body>
</html>
