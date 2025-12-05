/* Sidebar Staff */

document.addEventListener('DOMContentLoaded', function() {
    
    // Ambil semua link navigasi
    const navLinks = document.querySelectorAll('.nav-link');
    const currentPath = window.location.pathname;
    const currentPage = currentPath.split('/').pop();

    // Set active class berdasarkan halaman saat ini
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        
        // Cek apakah link sesuai dengan halaman saat ini
        if (href === currentPage || 
            (currentPage === 'index.php' && href === 'index.php') ||
            (currentPage === '' && href === 'index.php')) {
            link.classList.add('active');
        }

        // Tambahkan efek hover dengan animasi smooth
        link.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateX(8px)';
                this.style.transition = 'all 0.3s ease';
                this.style.paddingLeft = '20px';
            }
        });

        link.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateX(0)';
                this.style.paddingLeft = '';
            }
        });
    });

    // Konfirmasi logout
    const logoutLink = document.querySelector('a[href="../auth/logout.php"]');
    if (logoutLink) {
        logoutLink.addEventListener('click', function(e) {
            const confirmed = confirm('Apakah Anda yakin ingin keluar dari sistem?');
            if (!confirmed) {
                e.preventDefault();
            }
        });

        // Efek hover pada button logout
        logoutLink.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.transition = 'all 0.3s ease';
            this.style.boxShadow = '0 5px 15px rgba(220, 53, 69, 0.4)';
        });

        logoutLink.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = 'none';
        });
    }

    // Animasi loading untuk menu items
    const menuItems = document.querySelectorAll('.nav-item');
    menuItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-20px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.5s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, index * 100);
    });

    // Smooth scroll untuk sidebar
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        // Tambahkan efek shadow saat scroll
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                sidebar.style.boxShadow = '2px 0 15px rgba(0,0,0,0.3)';
            } else {
                sidebar.style.boxShadow = 'none';
            }
        });
    }

    // Toggle sidebar untuk mobile (responsive)
    const toggleButton = document.querySelector('.sidebar-toggle');
    if (toggleButton) {
        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    // Close sidebar saat klik di luar (mobile)
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            if (sidebar && !sidebar.contains(e.target) && !e.target.classList.contains('sidebar-toggle')) {
                sidebar.classList.remove('active');
            }
        }
    });

    // Animasi untuk greeting user
    const userGreeting = document.querySelector('.text-center.mb-4 strong');
    if (userGreeting) {
        userGreeting.style.opacity = '0';
        setTimeout(() => {
            userGreeting.style.transition = 'opacity 1s ease';
            userGreeting.style.opacity = '1';
        }, 300);
    }

    // Tambahkan indicator untuk menu aktif
    const activeLink = document.querySelector('.nav-link.active');
    if (activeLink) {
        activeLink.style.position = 'relative';
        const indicator = document.createElement('span');
        indicator.style.cssText = `
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 70%;
            background: #ffc107;
            border-radius: 0 4px 4px 0;
        `;
        activeLink.appendChild(indicator);
    }

    // Cek notifikasi dari URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('sukses') === 'login') {
        showSuccessNotification('Selamat datang kembali!');
    }

    // Fungsi menampilkan notifikasi sukses
    function showSuccessNotification(message) {
        const notification = document.createElement('div');
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
            padding: 16px 24px;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(72, 187, 120, 0.4);
            font-weight: 500;
            z-index: 9999;
            animation: slideIn 0.5s ease;
            max-width: 350px;
        `;
        
        document.body.appendChild(notification);

        setTimeout(function() {
            notification.style.animation = 'slideOut 0.5s ease';
            setTimeout(function() {
                notification.remove();
            }, 500);
        }, 3000);
    }

    // Tambahkan CSS animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

});
