document.addEventListener('DOMContentLoaded', function() {
    
    const form = document.querySelector('form');
    const namaInput = document.querySelector('input[name="nama"]');
    const usernameInput = document.querySelector('input[name="username"]');
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const submitButton = document.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        
        let errors = [];

        if (namaInput.value.trim() === '') {
            errors.push('Nama lengkap harus diisi');
        }

<<<<<<< HEAD
=======
        if (usernameInput.value.trim() === '') {
            errors.push('Username harus diisi');
        }

        if (emailInput.value.trim() === '') {
            errors.push('Email harus diisi');
        } else if (!isValidEmail(emailInput.value)) {
            errors.push('Format email tidak valid');
        }

        if (passwordInput.value.trim() === '') {
            errors.push('Password harus diisi');
        }

        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join('\n'));
            return false;
        }

        submitButton.disabled = true;
        submitButton.textContent = 'Memproses pendaftaran...';
    });

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    emailInput.addEventListener('blur', function() {
        if (this.value.trim() !== '' && !isValidEmail(this.value)) {
            this.style.borderColor = '#e53e3e';
        } else {
            this.style.borderColor = '#e2e8f0';
        }
>>>>>>> 6156d0eec5ae6de4c6dd7c599f6b0c2c6cf60f13
    });

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

    usernameInput.addEventListener('input', function() {
        this.value = this.value.replace(/\s/g, '');
    });

});
