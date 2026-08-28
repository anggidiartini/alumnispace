document.addEventListener("DOMContentLoaded", function () {
    // ===== 1. Mobile Nav Toggle =====
    const burgerBtn = document.getElementById("burgerBtn");
    const navbar = document.getElementById("navbar");

    if (burgerBtn && navbar) {
        burgerBtn.addEventListener("click", () => {
            navbar.classList.toggle("is-open");
        });

        document.querySelectorAll("#navLinks a, .nav-cta").forEach((link) => {
            link.addEventListener("click", () =>
                navbar.classList.remove("is-open"),
            );
        });
    }

    // ===== 2. Animated Stat Counters =====
    const statNumbers = document.querySelectorAll(".stat-number");

    function animateCount(el) {
        const target = parseInt(el.dataset.count, 10) || 0;
        const duration = 1200;
        const start = performance.now();

        function tick(now) {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.floor(eased * target).toLocaleString("id-ID");
            if (progress < 1) requestAnimationFrame(tick);
            else el.textContent = target.toLocaleString("id-ID");
        }
        requestAnimationFrame(tick);
    }

    // ===== 3. Scroll Reveal =====
    const revealTargets = document.querySelectorAll(
        ".stat-card, .gallery-card, .testi-card, .blog-card, .about-inner",
    );
    revealTargets.forEach((el) => el.classList.add("reveal"));

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");

                    if (entry.target.classList.contains("stat-card")) {
                        const num = entry.target.querySelector(".stat-number");
                        if (num && !num.dataset.done) {
                            num.dataset.done = "true";
                            animateCount(num);
                        }
                    }
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.2 },
    );

    revealTargets.forEach((el) => observer.observe(el));

    // ===== 4. Navbar Scroll & Transparent Effect =====
    if (navbar) {
        if (window.scrollY <= 50) {
            navbar.classList.add("navbar-transparent");
        }

        window.addEventListener("scroll", () => {
            if (window.scrollY > 10) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }

            if (window.scrollY > 50) {
                navbar.classList.remove("navbar-transparent");
            } else {
                navbar.classList.add("navbar-transparent");
            }
        });
    }

    // ===== 5. Audio Player Play/Pause Control (Auto-Play Attempt Included) =====
    const audioBox = document.querySelector(".hero-audio");
    const audioElement = document.querySelector("#bg-audio");
    const toggleBtn = document.querySelector(".audio-toggle");

    if (audioBox && audioElement) {
        // Coba langsung putar lagu saat halaman dimuat
        audioElement
            .play()
            .then(() => {
                audioBox.classList.remove("is-paused");
                if (toggleBtn) {
                    toggleBtn.innerHTML = `
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <rect x="3" y="2" width="3.5" height="12" rx="1" fill="currentColor" />
            <rect x="9.5" y="2" width="3.5" height="12" rx="1" fill="currentColor" />
          </svg>`;
                }
            })
            .catch((error) => {
                // Jika diblokir browser, otomatis set mode pause/diam
                audioBox.classList.add("is-paused");
                console.log(
                    "Autoplay dicegah browser (butuh klik pertama):",
                    error,
                );
            });

        // Kontrol klik untuk Play / Pause manual
        audioBox.addEventListener("click", function () {
            if (audioElement.paused) {
                audioElement
                    .play()
                    .then(() => {
                        audioBox.classList.remove("is-paused");

                        if (toggleBtn) {
                            toggleBtn.innerHTML = `
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                <rect x="3" y="2" width="3.5" height="12" rx="1" fill="currentColor" />
                <rect x="9.5" y="2" width="3.5" height="12" rx="1" fill="currentColor" />
              </svg>`;
                        }
                    })
                    .catch((error) => {
                        console.log("Gagal memutar audio:", error);
                    });
            } else {
                audioElement.pause();
                audioBox.classList.add("is-paused");

                if (toggleBtn) {
                    toggleBtn.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M4 2.5V13.5L13.5 8L4 2.5Z" fill="currentColor" />
            </svg>`;
                }
            }
        });
    }
});

// Script untuk mendeteksi saat section .stats masuk ke layar (scroll animation)
window.addEventListener("scroll", function () {
    const statsSection = document.querySelector(".stats");
    if (statsSection) {
        const position = statsSection.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.2;

        if (position < screenPosition) {
            statsSection.classList.add("appear");
        }
    }
});
