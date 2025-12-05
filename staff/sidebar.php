<style>
.sidebar {
    min-height: 100vh;
    width: 200px;
    background: #111827;
    color: #fff;
    padding: 20px;
    display: flex;
    flex-direction: column;
}

.sidebar h3 {
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
    font-size: 20px;
}

.sidebar .sidebar-user {
    text-align: center;
    margin-bottom: 15px;
    font-size: 14px;
    font-weight: bold;
}

.sidebar hr {
    border: none;
    border-top: 1px solid #444;
    margin: 15px 0;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
    flex: 1;
}

.sidebar ul li {
    margin-bottom: 8px;
}

.sidebar ul li a {
    display: block;
    padding: 10px 12px;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: 0.3s;
    font-size: 14px;
}

.sidebar ul li a:hover {
    background-color: #495057;
    color: #ffc107;
}

.sidebar ul li a.active {
    background-color: #0d6efd;
    color: #fff;
    font-weight: bold;
}

.sidebar .logout-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px 15px;
    background: #c62828;
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.sidebar .logout-btn:hover {
    background: #8e0000;
}
</style>

<div class="bg-dark text-white p-3 sidebar d-flex flex-column">
    <h3 class="mb-4 text-center fw-bold">E-Staff Panel</h3>

    <div class="sidebar-user">
        <?php echo 'Halo, ' . htmlspecialchars($_SESSION['nama']); ?>
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

    <a href="../auth/logout.php" class="logout-btn">
        🚪 LOGOUT
    </a>
</div>
