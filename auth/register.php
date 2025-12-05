<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pegawai</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <div class="register-wrapper">
        <div class="register-card">
            <div class="register-inner">

                <div class="register-header">
                    <h4 class="register-title">Daftar Akun Pegawai</h4>
                </div>

                <div class="register-body">

                    <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses') { ?>
                        <div class="alert-success">
                            Registrasi berhasil! Cek email untuk aktivasi.
                        </div>
                    <?php } ?>

                    <form action="register-proses.php" method="POST" class="register-form">

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" required placeholder="Contoh: Budi Santoso">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" required placeholder="Username untuk login">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Aktif</label>
                            <input type="email" id="email" name="email" required placeholder="email@contoh.com">
                            <small class="note">Link aktivasi akan dikirim ke sini.</small>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>

                        <input type="hidden" name="role" value="staff">

                        <div class="form-submit">
                            <button type="submit" name="register" class="btn-register">Daftar Sekarang</button>
                        </div>

                    </form>

                </div>

                <div class="register-footer">
                    Sudah punya akun?
                    <a href="login.php" class="link-login">Login disini</a>
                </div>

            </div>
        </div>
    </div>

<script src="js/register.js"></script>
</body>
</html>
