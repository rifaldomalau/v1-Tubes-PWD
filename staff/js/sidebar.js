document.addEventListener('DOMContentLoaded', function() {

    const navLinks = document.querySelectorAll('.nav-link');
    const currentPath = window.location.pathname;
    const currentPage = currentPath.split('/').pop();

    navLinks.forEach(link => {
        const href = link.getAttribute('href');

        if (href === currentPage || 
            (currentPage === 'index.php' && href === 'index.php') ||
            (currentPage === '' && href === 'index.php')) {
            link.classList.add('active');
        }

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

    const logoutLink = document.querySelector('a[href="../auth/logout.php"]');
    if (logoutLink) {
        logoutLink.addEventListener('click', function(e) {
            const confirmed = confirm('Apakah Anda yakin ingin keluar dari sistem?');
            if (!confirmed) {
                e.preventDefault();
            }
        });

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

    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                sidebar.style.boxShadow = '2px 0 15px rgba(0,0,0,0.3)';
            } else {
                sidebar.style.boxShadow = 'none';
            }
        });
    }

    const toggleButton = document.querySelector('.sidebar-toggle');
    if (toggleButton) {
        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            if (sidebar && !sidebar.contains(e.target) && !e.target.classList.contains('sidebar-toggle')) {
                sidebar.classList.remove('active');
            }
        }
    });

    const userGreeting = document.querySelector('.text-center.mb-4 strong');
    if (userGreeting) {
        userGreeting.style.opacity = '0';
        setTimeout(() => {
            userGreeting.style.transition = 'opacity 1s ease';
            userGreeting.style.opacity = '1';
        }, 300);
    }

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

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('sukses') === 'login') {
        showSuccessNotification('Selamat datang kembali!');
    }

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
