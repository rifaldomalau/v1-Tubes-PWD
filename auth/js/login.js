// buat halaman login interaktif
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        const username = form.username.value.trim();
        const password = form.password.value.trim();

        //validasi input kosong
        if (username === "" || password === "") {
            e.preventDefault();
            alert("Username dan password tidak boleh kosong!");
            return;
        }

        //validasi panjang pw
        // if (password.length < 4) {
        //     e.preventDefault();
        //     alert("Password harus minimal 4 karakter!");
        //     return;
        // }
    });
});
