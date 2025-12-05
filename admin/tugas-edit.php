<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
include('../config/koneksi.php');

$id_tugas = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM tugas WHERE id='$id_tugas'");
$data = mysqli_fetch_assoc($query);

if(isset($_POST['update_tugas'])){
    $judul     = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $deadline  = $_POST['deadline'];
    $status    = $_POST['status'];
    $user_id   = $_POST['user_id'];

    $update = mysqli_query($koneksi, "UPDATE tugas SET 
        user_id='$user_id',
        judul='$judul', 
        deskripsi='$deskripsi', 
        deadline='$deadline',
        status='$status'
        WHERE id='$id_tugas'");
    
    if($update){
        echo "<script>alert('Tugas berhasil diupdate!'); window.location='tugas.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Tugas - Admin</title>
    <link rel="stylesheet" href="css/tugas-edit.css">
</head>
<body>

    <div class="edit-container">
        <div class="edit-wrapper">
            <div class="edit-card">
                <div class="edit-title">Edit Data Tugas</div>

                <div class="edit-body">
                    <form method="POST" class="edit-form">
                        
                        <div class="form-group">
                            <label>Tugas Untuk Siapa?</label>
                            <select name="user_id" required>
                                <?php 
                                $staff_query = mysqli_query($koneksi, "SELECT * FROM users WHERE role='staff' AND is_active=1");
                                while($staff = mysqli_fetch_assoc($staff_query)){
                                    $selected = ($staff['id'] == $data['user_id']) ? 'selected' : '';
                                    echo "<option value='".$staff['id']."' $selected>".$staff['nama_lengkap']."</option>";
                                } 
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Judul Tugas</label>
                            <input type="text" name="judul" value="<?php echo $data['judul']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" rows="3"><?php echo $data['deskripsi']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Deadline</label>
                            <input type="date" name="deadline" value="<?php echo $data['deadline']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status">
                                <option value="Belum Selesai" <?php if($data['status']=='Belum Selesai') echo 'selected'; ?>>Belum Selesai</option>
                                <option value="Selesai" <?php if($data['status']=='Selesai') echo 'selected'; ?>>Selesai</option>
                            </select>
                        </div>

                        <div class="form-action">
                            <a href="tugas.php" class="btn-cancel">Batal</a>
                            <button type="submit" name="update_tugas" class="btn-save">Simpan Perubahan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
