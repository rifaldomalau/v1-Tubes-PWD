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
                this.style.transform = 'translateX(5px)';
                this.style.transition = 'all 0.3s ease';
            }
        });

        link.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    const logoutLink = document.querySelector('a[href="../auth/logout.php"]');
    if (logoutLink) {
        logoutLink.classList.add('nav-link'); // Tambahkan class nav-link
        logoutLink.addEventListener('click', function(e) {
            const confirmed = confirm('Apakah Anda yakin ingin keluar dari sistem?');
            if (!confirmed) {
                e.preventDefault();
            }
        });
    }

    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                sidebar.style.boxShadow = '2px 0 15px rgba(0,0,0,0.2)';
            } else {
                sidebar.style.boxShadow = '2px 0 10px rgba(0,0,0,0.1)';
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

    navLinks.forEach((link, index) => {
        link.style.opacity = '0';
        link.style.transform = 'translateX(-20px)';
        
        setTimeout(() => {
            link.style.transition = 'all 0.5s ease';
            link.style.opacity = '1';
            link.style.transform = 'translateX(0)';
        }, index * 100);
    });

});
