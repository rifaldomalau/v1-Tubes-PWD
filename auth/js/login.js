// buat halaman login interaktif
document.addEventListener('DOMContentLoaded', function() {
    
    const form = document.querySelector('form');
    const namaInput = document.querySelector('input[name="nama"]');
    const usernameInput = document.querySelector('input[name="username"]');
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const submitButton = document.querySelector('button[type="submit"]');

    // Validasi form sebelum submit
    form.addEventListener('submit', function(e) {
        
        let errors = [];

        // Validasi nama lengkap
        if (namaInput.value.trim() === '') {
            errors.push('Nama lengkap harus diisi');
        }

<<<<<<< HEAD
        //validasi panjang pw
        // if (password.length < 4) {
        //     e.preventDefault();
        //     alert("Password harus minimal 4 karakter!");
        //     return;
        // }
=======
        // Validasi username
        if (usernameInput.value.trim() === '') {
            errors.push('Username harus diisi');
        }

        // Validasi email
        if (emailInput.value.trim() === '') {
            errors.push('Email harus diisi');
        } else if (!isValidEmail(emailInput.value)) {
            errors.push('Format email tidak valid');
        }

        // Validasi password
        if (passwordInput.value.trim() === '') {
            errors.push('Password harus diisi');
        }

        // Jika ada error, tampilkan dan cegah submit
        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join('\n'));
            return false;
        }

        // Loading state pada button
        submitButton.disabled = true;
        submitButton.textContent = 'Memproses pendaftaran...';
    });

    // Fungsi validasi email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Real-time validasi email
    emailInput.addEventListener('blur', function() {
        if (this.value.trim() !== '' && !isValidEmail(this.value)) {
            this.style.borderColor = '#e53e3e';
        } else {
            this.style.borderColor = '#e2e8f0';
        }
>>>>>>> 6156d0eec5ae6de4c6dd7c599f6b0c2c6cf60f13
    });

    // Auto hide alert message setelah 5 detik
    const alertMessage = document.querySelector('.alert-message');
    if (alertMessage) {
        setTimeout(function() {
            alertMessage.style.transition = 'opacity 0.5s ease';
            alertMessage.style.opacity = '0';
            setTimeout(function() {
                alertMessage.remove();
            }, 500);
        }, 5000);
    }

    // Hapus spasi dari username
    usernameInput.addEventListener('input', function() {
        this.value = this.value.replace(/\s/g, '');
    });

});
