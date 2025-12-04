<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Staff</title>
</head>
<body>

    <div>
        <div>
            <div>
                <div>
                    <h3>Login E-Staff</h3>
                    <small>Masuk untuk mulai bekerja</small>
                </div>
                <div>
                    
                    <?php if(isset($_GET['pesan'])){ ?>
                        <div>
                            <?php echo htmlspecialchars($_GET['pesan']); ?>
                        </div>
                    <?php } ?>

                    <form action="login-proses.php" method="POST">
                        <div>
                            <label>Username</label>
                            <input type="text" name="username" required>
                        </div>
                        <div>
                            <label>Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div>
                            <button type="submit" name="login">Masuk Sistem</button>
                        </div>
                    </form>

                </div>
                <div>
                    Belum punya akun? 
                    <a href="register.php">Daftar Pegawai</a>
                </div>
            </div>
        </div>
    </div>
<script src="login.js"></script>
</body>
</html>
