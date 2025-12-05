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
        }
    });
});

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
