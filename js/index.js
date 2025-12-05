<<<<<<< HEAD
//ANIMASI SCROLL NAVBARNYA
const navbar = document.querySelector("nav");

window.addEventListener("scroll", () => {
    if (window.scrollY > 20) {
        navbar.classList.add("nav-scrolled");
    } else {
        navbar.classList.remove("nav-scrolled");
    }
});

//Supaya Smooth
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function (e) {
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: "smooth" });
=======
// ini untuk js yang di root index.php
// Smooth scroll untuk navigasi
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
>>>>>>> 6156d0eec5ae6de4c6dd7c599f6b0c2c6cf60f13
        }
    });
});

<<<<<<< HEAD
// awal muncul scroll
const observer = new IntersectionObserver(
    entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animate-show");
            }
        });
    },
    { threshold: 0.15 }
);

document.querySelectorAll(".fade").forEach(el => observer.observe(el));

const heroTitle = document.querySelector(".hero-title");
if (heroTitle) {
    const text = heroTitle.innerText;
    heroTitle.innerText = "";
    let i = 0;

    function typeEffect() {
        if (i < text.length) {
            heroTitle.innerText += text.charAt(i);
            i++;
            setTimeout(typeEffect, 40);
        }
    }

    typeEffect();
}
=======
// Navbar scroll effect
const nav = document.querySelector('nav');
let lastScroll = 0;

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    // Tambah shadow saat scroll
    if (currentScroll > 50) {
        nav.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        nav.style.backgroundColor = '#ffffff';
    } else {
        nav.style.boxShadow = 'none';
        nav.style.backgroundColor = 'transparent';
    }

    // Hide/show navbar on scroll (opsional)
    if (currentScroll > lastScroll && currentScroll > 500) {
        nav.style.transform = 'translateY(-100%)';
    } else {
        nav.style.transform = 'translateY(0)';
    }

    lastScroll = currentScroll;
});

// Intersection Observer untuk animasi fade-in
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe semua section
document.querySelectorAll('section').forEach(section => {
    section.style.opacity = '0';
    section.style.transform = 'translateY(30px)';
    section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(section);
});

// Animasi untuk fitur cards
const featureCards = document.querySelectorAll('#fitur > div > div > div');
featureCards.forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;
    
    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                cardObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    cardObserver.observe(card);
});

// Animasi untuk team members
const teamMembers = document.querySelectorAll('#team > div > div > div');
teamMembers.forEach((member, index) => {
    member.style.opacity = '0';
    member.style.transform = 'scale(0.9)';
    member.style.transition = `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;
    
    const memberObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'scale(1)';
                memberObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    memberObserver.observe(member);
});

// Hover effect untuk buttons
const buttons = document.querySelectorAll('a[href*="auth"], a[href*="admin"], a[href*="staff"]');
buttons.forEach(button => {
    button.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
        this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
    });
    
    button.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = 'none';
    });
});

// Parallax effect untuk hero section (opsional)
const hero = document.querySelector('section:first-of-type');
if (hero) {
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        if (scrolled < window.innerHeight) {
            hero.style.transform = `translateY(${scrolled * 0.5}px)`;
            hero.style.opacity = 1 - (scrolled / window.innerHeight);
        }
    });
}

// Counter animation untuk statistik (jika diperlukan di masa depan)
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(start);
        }
    }, 16);
}

// Mobile menu toggle (jika ada hamburger menu)
const menuToggle = document.querySelector('.menu-toggle');
const navMenu = document.querySelector('nav ul');

if (menuToggle && navMenu) {
    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        menuToggle.classList.toggle('active');
    });
    
    // Close menu saat link diklik
    document.querySelectorAll('nav ul li a').forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('active');
            menuToggle.classList.remove('active');
        });
    });
}

// Loading animation
window.addEventListener('load', () => {
    document.body.classList.add('loaded');
    
    // Fade in sections class
    const fadeInClass = document.createElement('style');
    fadeInClass.textContent = `
        .fade-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    `;
    document.head.appendChild(fadeInClass);
});

// Active nav link highlighting
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('nav ul li a[href^="#"]');

window.addEventListener('scroll', () => {
    let current = '';
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (pageYOffset >= (sectionTop - 200)) {
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

// Prevent scroll jank
let ticking = false;
window.addEventListener('scroll', () => {
    if (!ticking) {
        window.requestAnimationFrame(() => {
            ticking = false;
        });
        ticking = true;
    }
});

console.log('E-Staff: JavaScript loaded successfully ✓');
>>>>>>> 6156d0eec5ae6de4c6dd7c599f6b0c2c6cf60f13
