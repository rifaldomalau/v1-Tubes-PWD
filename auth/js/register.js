document.addEventListener("DOMContentLoaded", function () {

    //untuk ambil element form
    const form = document.querySelector("form");

    //ambil input
    const nama = form.querySelector("input[name='nama']");
    const username = form.querySelector("input[name='username']");
    const email = form.querySelector("input[name='email']");
    const password = form.querySelector("input[name='password']");

    form.addEventListener("submit", function (e) {

        //validasi nama
        if (nama.value.trim() === "") {
            alert("Nama lengkap tidak boleh kosong!");
            e.preventDefault();
            return;
        }

        if (nama.value.trim().length < 3) {
            alert("Nama harus berisi minimal 3 karakter!");
            e.preventDefault();
            return;
        }

        //validasi usn
        if (username.value.trim() === "") {
            alert("Username tidak boleh kosong!");
            e.preventDefault();
            return;
        }

        if (username.value.trim().length < 4) {
            alert("Username harus minimal 4 karakter!");
            e.preventDefault();
            return;
        }

        //validasi email
        if (email.value.trim() === "") {
            alert("Email tidak boleh kosong!");
            e.preventDefault();
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value)) {
            alert("Format email tidak valid!");
            e.preventDefault();
            return;
        }

        //validasi pw
        if (password.value.trim() === "") {
            alert("Password tidak boleh kosong!");
            e.preventDefault();
            return;
        }

        if (password.value.length < 6) {
            alert("Password harus minimal 6 karakter!");
            e.preventDefault();
            return;
        }

        
        alert("Registrasi sedang diproses...");
        
    });
});
