<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Staff</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="login-container">
        <div class="login-wrapper">
            <div class="login-card">

                <div class="login-header">
                    <h3 class="login-title">Login E-Staff</h3>
                    <small class="login-subtitle">Masuk untuk mulai bekerja</small>
                </div>

                <div class="login-body">

                    <?php if(isset($_GET['pesan'])){ ?>
                        <div class="login-alert">
                            <?php echo htmlspecialchars($_GET['pesan']); ?>
                        </div>
                    <?php } ?>

                    <form action="login-proses.php" method="POST" class="login-form">
                        
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="input-field" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="input-field" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="login" class="btn-login">Masuk Sistem</button>
                        </div>

                    </form>

                </div>

                <div class="login-footer">
                    Belum punya akun?
                    <a href="register.php" class="register-link">Daftar Pegawai</a>
                </div>

            </div>
        </div>
    </div>

<script src="js/login.js"></script>
</body>
</html>
