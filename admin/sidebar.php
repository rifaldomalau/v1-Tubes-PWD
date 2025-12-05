<style>
   
    .sidebar {
        min-height: 100vh;
        width: 260px;
        flex-shrink: 0;
        background: #000535;
        color: #fff;
        padding: 20px;
        box-shadow: 2px 0 8px rgba(0,0,0,0.1);
    }

    .sidebar-title {
        margin: 0 0 10px 0;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
    }

    .sidebar-divider {
        border: none;
        border-top: 1px solid #444;
        margin: 15px 0;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu li {
        margin-bottom: 8px;
    }

    
    .sidebar-link {
        display: block;
        padding: 10px 12px;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: 0.3s;
    }

    .sidebar-link:hover {
        background-color: #495057;
        color: #ffc107;
    }

    .sidebar-link.active {
        background-color: #0d6efd;
        font-weight: bold;
        color: #fff;
    }

    .sidebar-logout {
        text-align: center;
        margin-top: 20px;
    }

    .logout-btn {
        display: inline-block;
        padding: 10px 15px;
        background: #c62828;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s;
    }

    .logout-btn:hover {
        background: #8e0000;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 200px;
            padding: 15px;
        }

        .sidebar-title {
            font-size: 18px;
        }

        .sidebar-link {
            padding: 8px 10px;
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 999;
        }
    }
</style>

<div class="sidebar">
    <h3 class="sidebar-title">E-Staff Admin</h3>
    <hr class="sidebar-divider">

    <ul class="sidebar-menu">

        <li>
            <a class="sidebar-link <?php echo ($page == 'dashboard') ? 'active' : ''; ?>" href="index.php">
                📊 Dashboard
            </a>
        </li>

        <li>
            <a class="sidebar-link <?php echo ($page == 'tugas') ? 'active' : ''; ?>" href="tugas.php">
                📋 Kelola Tugas
            </a>
        </li>

        <li>
            <a class="sidebar-link <?php echo ($page == 'staff') ? 'active' : ''; ?>" href="staff-data.php">
                👥 Data Pegawai
            </a>
        </li>

        <li>
            <a class="sidebar-link <?php echo ($page == 'persetujuan') ? 'active' : ''; ?>" href="persetujuan.php">
                ✅ Persetujuan Izin
            </a>
        </li>

        <li>
            <a class="sidebar-link" href="cetak-laporan.php" target="_blank">
                🖨️ Cetak Laporan
            </a>
        </li>

    </ul>

    <hr class="sidebar-divider">

    <div class="sidebar-logout">
        <a href="../auth/logout.php" class="logout-btn">
            🚪 LOGOUT
        </a>
    </div>
</div>
<script src="js/sidebar.js"></script>
