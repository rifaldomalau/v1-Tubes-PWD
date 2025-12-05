<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <title>E-Staff - Sistem Absensi & Manajemen Pegawai</title>
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <div class="nav-container">
            <a href="#" class="logo">E-STAFF</a>

            <div class="nav-menu">
                <ul>
                    <li><a href="#fitur">Fitur</a></li>
                    <li><a href="#team">Tim Kami</a></li>

                    <?php if(isset($_SESSION['user_id'])) { ?>
                        <li class="user-info">
                            <span>Halo, <?php echo $_SESSION['nama']; ?></span>

                            <?php if($_SESSION['role'] == 'admin') { ?>
                                <a href="admin/index.php" class="btn-dashboard">Dashboard Admin</a>
                            <?php } else { ?>
                                <a href="staff/index.php" class="btn-dashboard">Dashboard Staff</a>
                            <?php } ?>
                        </li>

                    <?php } else { ?>
                        <li><a href="auth/login.php">Login</a></li>
                        <li><a href="auth/register.php">Daftar</a></li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Kelola Kinerja Pegawai Lebih Mudah</h1>
            <p class="hero-sub">
                Sistem manajemen kepegawaian modern dengan fitur Geolocation, Pelaporan Real-time, dan Manajemen Tugas.
            </p>

            <?php if(!isset($_SESSION['user_id'])) { ?>
                <div class="hero-buttons">
                    <a href="auth/register.php" class="hero-btn">Mulai Sekarang</a>
                    <a href="auth/login.php" class="hero-btn">Masuk Sistem</a>
                </div>
            <?php } else { ?>
                <p class="hero-welcome">Selamat Datang kembali! Akses dashboard Anda sekarang.</p>
            <?php } ?>
        </div>
    </section>

    <!-- FITUR -->
    <section id="fitur">
        <div>
            <h2>Fitur Unggulan</h2>
            <p>Semua yang Anda butuhkan untuk manajemen kantor</p>

            <div class="fitur-grid">

                <div class="card-hover">
                    <h4>Absensi Geolocation</h4>
                    <p>Sistem mencatat lokasi pegawai saat absen untuk memastikan kehadiran valid.</p>
                </div>

                <div class="card-hover">
                    <h4>Manajemen Tugas</h4>
                    <p>Admin memberikan tugas, staff menandai selesai secara real-time.</p>
                </div>

                <div class="card-hover">
                    <h4>Laporan PDF Otomatis</h4>
                    <p>Rekap kehadiran dapat dicetak menjadi PDF dengan satu klik.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- TEAM -->
    <section id="team">
        <div>
            <h2>Tim Pengembang</h2>
            <p>Kelompok Tugas Besar Pemrograman Web</p>

            <div class="team-grid">

                <div class="card-hover">
                    <img src="https://ui-avatars.com/api/?name=Hot+Malau&background=random" width="100" height="100">
                    <h6>Hot Rifaldo Malau</h6>
                    <small>NPM: 230712537</small>
                </div>

                <div class="card-hover">
                    <img src="https://ui-avatars.com/api/?name=Kelvin+Kelvin&background=random" width="100" height="100">
                    <h6>Kelvin</h6>
                    <small>NPM: 230712436</small>
                </div>

                <div class="card-hover">
                    <img src="https://ui-avatars.com/api/?name=Jes+Mei&background=random" width="100" height="100">
                    <h6>Jessica Meisya Pratami</h6>
                    <small>NPM: 230712444</small>
                </div>

                <div class="card-hover">
                    <img src="https://ui-avatars.com/api/?name=Jocelyn&background=random" width="100" height="100">
                    <h6>Jocelyn</h6>
                    <small>NPM: 230712396</small>
                </div>

                <div class="card-hover">
                    <img src="https://ui-avatars.com/api/?name=Jehu+Santo&background=random" width="100" height="100">
                    <h6>Jehu Santo Simanungkalit</h6>
                    <small>NPM: 230712703</small>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div>
            <h2>Siap Meningkatkan Produktivitas?</h2>
            <p>Bergabunglah dengan sistem E-Staff sekarang.</p>
            <a href="auth/register.php" class="cta-btn">Daftar Akun Baru</a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>&copy; <?php echo date('Y'); ?> E-Staff Application.</p>
        <small>Dibuat oleh Kelompok 3</small>
    </footer>

    <script src="js/index.js"></script>

</body>
</html>
