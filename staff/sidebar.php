<div class="bg-dark text-white p-3 sidebar d-flex flex-column">
    <h3 class="mb-4 text-center fw-bold">E-Staff Panel</h3>
    <div class="text-center mb-4">
        <strong><?php echo 'Halo, ' . htmlspecialchars($_SESSION['nama']); ?></strong>
    </div>
    <hr>
    <ul class="nav flex-column mb-auto">
        <li class="nav-item">
            <a href="index.php" class="nav-link <?= ($page=='dashboard')?'active':'' ?>">⏱️ Absensi Harian</a>
        </li>
        <li class="nav-item">
            <a href="tugas.php" class="nav-link <?= ($page=='tugas')?'active':'' ?>">📋 Tugas Saya</a>
        </li>
        <li class="nav-item">
            <a href="profil.php" class="nav-link <?= ($page=='profil')?'active':'' ?>">👤 Profil & Foto</a>
        </li>
        <li class="nav-item">
            <a href="riwayat.php" class="nav-link <?= ($page=='riwayat')?'active':'' ?>">📅 Riwayat Absen</a>
        </li>
        <li class="nav-item">
            <a href="izin.php" class="nav-link <?= ($page=='izin')?'active':'' ?>">🤒 Izin / Sakit</a>
        </li>
    </ul>
    <hr>
    <a href="../auth/logout.php" class="d-flex align-items-center text-white text-decoration-none p-2 bg-danger rounded justify-content-center">
        <strong>🚪 LOGOUT</strong>
    </a>
</div>
