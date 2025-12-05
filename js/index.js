// navbar nya
const nav = document.querySelector('nav');
let lastScroll = 0;

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    // Efek background & shadow waktu scroll
    if (currentScroll > 50) {
        nav.style.backgroundColor = 'rgba(255, 255, 255, 0.9)';
        nav.style.backdropFilter = 'blur(8px)';
        nav.style.boxShadow = '0 2px 12px rgba(0,0,0,0.15)';
    } else {
        nav.style.backgroundColor = 'transparent';
        nav.style.backdropFilter = 'none';
        nav.style.boxShadow = 'none';
    }

    // sembunyiin navbar scroll
    if (currentScroll > lastScroll && currentScroll > 500) {
        nav.style.transform = 'translateY(-100%)';
    } else {
        nav.style.transform = 'translateY(0)';
    }

    lastScroll = currentScroll;
});

// scroll halus
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// animasi scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-show');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('section, .card-hover').forEach(el => {
    el.classList.add('fade');
    observer.observe(el);
});

const hero = document.querySelector('.hero-title');
if (hero) {
    const text = hero.innerText;
    hero.innerText = '';
    let i = 0;

    function typeEffect() {
        if (i < text.length) {
            hero.innerText += text.charAt(i);
            i++;
            setTimeout(typeEffect, 40);
        }
    }
    typeEffect();
}

const heroSection = document.querySelector('.hero');
if (heroSection) {
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        if (scrolled < window.innerHeight) {
            heroSection.style.transform = `translateY(${scrolled * 0.5}px)`;
            heroSection.style.opacity = 1 - (scrolled / window.innerHeight);
        }
    });
}

const buttons = document.querySelectorAll('a[href*="auth"], a[href*="admin"], a[href*="staff"], .hero-btn, .cta-btn');
buttons.forEach(button => {
    button.addEventListener('mouseenter', () => {
        button.style.transform = 'translateY(-2px)';
        button.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
    });
    button.addEventListener('mouseleave', () => {
        button.style.transform = 'translateY(0)';
        button.style.boxShadow = 'none';
    });
});

const menuToggle = document.querySelector('.menu-toggle');
const navMenu = document.querySelector('nav ul');

if (menuToggle && navMenu) {
    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        menuToggle.classList.toggle('active');
    });

    navMenu.querySelectorAll('li a').forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('active');
            menuToggle.classList.remove('active');
        });
    });
}

const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('nav ul li a[href^="#"]');

window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (window.pageYOffset >= (sectionTop - 200)) {
            current = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});

console.log('E-Staff: JavaScript loaded successfully ✓');
