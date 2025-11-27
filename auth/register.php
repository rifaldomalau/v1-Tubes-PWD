<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pegawai</title>
</head>
<body>

    <div>
        <div>
            <div>
                <div>
                    <h4>Daftar Akun Pegawai</h4>
                </div>

                <div>

                    <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses') { ?>
                        <div>
                            Registrasi berhasil! Cek email untuk aktivasi.
                        </div>
                    <?php } ?>

                    <form action="register-proses.php" method="POST">

                        <div>
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" required placeholder="Contoh: Budi Santoso">
                        </div>

                        <div>
                            <label>Username</label>
                            <input type="text" name="username" required placeholder="Username untuk login">
                        </div>

                        <div>
                            <label>Email Aktif</label>
                            <input type="email" name="email" required placeholder="email@contoh.com">
                            <small>Link aktivasi akan dikirim ke sini.</small>
                        </div>

                        <div>
                            <label>Password</label>
                            <input type="password" name="password" required>
                        </div>

                        <input type="hidden" name="role" value="staff">

                        <div>
                            <button type="submit" name="register">Daftar Sekarang</button>
                        </div>

                    </form>

                </div>

                <div>
                    Sudah punya akun? <a href="login.php">Login disini</a>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
