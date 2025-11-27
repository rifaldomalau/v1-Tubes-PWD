<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: ../auth/login.php");
    exit;
}
include('../config/koneksi.php');

$id_saya = $_SESSION['user_id'];

if(isset($_GET['selesai'])){
    $id_tugas = $_GET['selesai'];
    mysqli_query($koneksi, "UPDATE tugas SET status='Selesai' WHERE id='$id_tugas' AND user_id='$id_saya'");
    echo "<script>alert('Kerja bagus! Tugas selesai.'); window.location='tugas.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas Saya</title>
</head>
<body>

<div class="d-flex">
    
    <?php 
    $page = 'tugas'; 
    include('sidebar.php'); 
    ?>

    <div class="content">
        <h2>Daftar Tugas Harian Saya</h2>

        <div class="row">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM tugas WHERE user_id='$id_saya' ORDER BY status ASC, deadline ASC");
            
            if(mysqli_num_rows($query) == 0){
                echo "<div><div>Belum ada tugas baru untuk Anda.</div></div>";
            }

            while($row = mysqli_fetch_assoc($query)){
            ?>
            <div>
                <div>
                    <div>
                        <h5><?php echo $row['judul']; ?></h5>
                        <small><?php echo date('d M Y', strtotime($row['deadline'])); ?></small>
                    </div>
                    <div>
                        <p><?php echo $row['deskripsi']; ?></p>
                        <hr>
                        <div>
                            <span>Status: </span>
                            
                            <?php if($row['status'] == 'Belum Selesai'){ ?>
                                <a href="tugas.php?selesai=<?php echo $row['id']; ?>" onclick="return confirm('Yakin tugas ini sudah beres?')">
                                    ✅ Tandai Selesai
                                </a>
                            <?php } else { ?>
                                <button disabled>TUNTAS 🎉</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

</div>
</body>
</html>
