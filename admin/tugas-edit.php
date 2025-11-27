<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
include('../config/koneksi.php');

// Ambil ID Tugas dari URL
$id_tugas = $_GET['id'];

// Ambil Data Tugas yang mau diedit
$query = mysqli_query($koneksi, "SELECT * FROM tugas WHERE id='$id_tugas'");
$data = mysqli_fetch_assoc($query);

// proses simpan edit
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
</head>
<body>

    <div>
        <div>
            <div>
                <div>
                    Edit Data Tugas
                </div>
                <div>
                    <form method="POST">
                        
                        <div>
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

                        <div>
                            <label>Judul Tugas</label>
                            <input type="text" name="judul" value="<?php echo $data['judul']; ?>" required>
                        </div>

                        <div>
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" rows="3"><?php echo $data['deskripsi']; ?></textarea>
                        </div>

                        <div>
                            <label>Deadline</label>
                            <input type="date" name="deadline" value="<?php echo $data['deadline']; ?>" required>
                        </div>

                        <div>
                            <label>Status</label>
                            <select name="status">
                                <option value="Belum Selesai" <?php if($data['status']=='Belum Selesai') echo 'selected'; ?>>Belum Selesai</option>
                                <option value="Selesai" <?php if($data['status']=='Selesai') echo 'selected'; ?>>Selesai</option>
                            </select>
                        </div>

                        <div>
                            <a href="tugas.php">Batal</a>
                            <button type="submit" name="update_tugas">Simpan Perubahan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
