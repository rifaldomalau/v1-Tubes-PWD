<?php
session_start();
include('../config/koneksi.php');

if (isset($_POST['update'])) {

    $id   = $_SESSION['user_id'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    
    
    $nama_file = $_FILES['foto']['name'];
    $ukuran    = $_FILES['foto']['size'];
    $tmp_name  = $_FILES['foto']['tmp_name'];
    $error     = $_FILES['foto']['error'];
    $ekstensi_diperbolehkan = ['jpg', 'jpeg', 'png'];

    // JIKA User TIDAK upload foto (misal cuma ganti nama)
    if ($error === 4) {
        $query = "UPDATE users SET nama_lengkap = '$nama' WHERE id = '$id'";
        if (mysqli_query($koneksi, $query)) {
            $_SESSION['nama'] = $nama; 
            header("Location: profil.php?pesan=sukses");
        } else {
            header("Location: profil.php?pesan=gagal");
        }
    } 
    // JIKA User UPLOAD foto baru
    else {
        $ekstensi_gambar = explode('.', $nama_file);
        $ekstensi_gambar = strtolower(end($ekstensi_gambar));

        if (in_array($ekstensi_gambar, $ekstensi_diperbolehkan)) {
            if ($ukuran < 2048000) {
                $nama_file_baru = time() . '_' . $nama_file;
                
                // pindahin file ke folder assets/img
                move_uploaded_file($tmp_name, '../assets/img/' . $nama_file_baru);

                // Update Database (Nama & Foto)
                $query = "UPDATE users SET nama_lengkap = '$nama', foto_profil = '$nama_file_baru' WHERE id = '$id'";
                
                if (mysqli_query($koneksi, $query)) {
                    $_SESSION['nama'] = $nama;
                    header("Location: profil.php?pesan=sukses");
                } else {
                    header("Location: profil.php?pesan=gagal");
                }
            } else {
                echo "<script>alert('Ukuran file terlalu besar! Maks 2MB'); window.location='profil.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi file tidak valid! Harus JPG/PNG'); window.location='profil.php';</script>";
        }
    }

} else {
    header("Location: index.php");
}
?>