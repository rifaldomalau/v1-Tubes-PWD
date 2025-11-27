<style>
    .sidebar { min-height: 100vh; width: 280px; flex-shrink: 0; }
    .nav-link { color: white; margin-bottom: 5px; }
    .nav-link:hover { background-color: #495057; color: #ffc107; border-radius: 5px; }
    .nav-link.active { background-color: #0d6efd; color: white; border-radius: 5px; font-weight: bold; }
</style>

<div>
    <h3>E-Staff Admin</h3>
    <hr>
    <ul>

        <li>
            <a href="index.php" <?php if($page == 'dashboard'){ echo 'style="font-weight:bold"'; } ?>>
                📊 Dashboard
            </a>
        </li>

        <li>
            <a href="tugas.php" <?php if($page == 'tugas'){ echo 'style="font-weight:bold"'; } ?>>
                📋 Kelola Tugas
            </a>
        </li>

        <li>
            <a href="staff-data.php" <?php if($page == 'staff'){ echo 'style="font-weight:bold"'; } ?>>
                👥 Data Pegawai
            </a>
        </li>

        <li>
            <a href="persetujuan.php" <?php if($page == 'persetujuan'){ echo 'style="font-weight:bold"'; } ?>>
                ✅ Persetujuan Izin
            </a>
        </li>

        <li>
            <a href="cetak-laporan.php" target="_blank">
                🖨️ Cetak Laporan
            </a>
        </li>

    </ul>
    <hr>
    <div>
        <a href="../auth/logout.php">
            <strong>🚪 LOGOUT</strong>
        </a>
    </div>
</div>
