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

document.addEventListener("DOMContentLoaded", function () {
    const musicBtn = document.getElementById("musicToggleBtn");
    const bgMusic = document.getElementById("bgMusic");

    if (!musicBtn || !bgMusic) return; // Mencegah error jika elemen tidak ada di halaman lain

    const iconPause = musicBtn.querySelector(".icon-pause");
    const iconPlay = musicBtn.querySelector(".icon-play");

    musicBtn.addEventListener("click", function () {
        // Cek status saat ini
        if (musicBtn.classList.contains("playing")) {
            // Ubah ke status PAUSE (Berhenti gerak & berhenti suara)
            musicBtn.classList.remove("playing");
            if (iconPause) iconPause.style.display = "none";
            if (iconPlay) iconPlay.style.display = "block";
            bgMusic.pause();
        } else {
            // Ubah ke status PLAY (Bergerak & bersuara)
            musicBtn.classList.add("playing");
            if (iconPause) iconPause.style.display = "block";
            if (iconPlay) iconPlay.style.display = "none";
            bgMusic.play().catch((error) => {
                console.log("Autoplay dicegah browser, butuh interaksi user.");
            });
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".navbar-container");

    if (navbar) {
        window.addEventListener("scroll", function () {
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const section3 = document.querySelector("#section-3");

    if (section3) {
        const observer = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        section3.classList.add("section-visible");
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15 },
        );

        observer.observe(section3);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const section2 = document.querySelector("#section-2");
    const statsContainer = document.querySelector(".stats-container");
    const numbers = document.querySelectorAll(".stat-number");
    let animated = false;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting && !animated) {
                    // 1. Munculkan container dari bawah
                    statsContainer.classList.add("visible");

                    // 2. Jalankan animasi hitung angka (Counter)
                    numbers.forEach((num) => {
                        const target = +num.getAttribute("data-target");
                        const suffix = num.getAttribute("data-suffix") || "";
                        let count = 0;

                        // Kecepatan hitung (semakin kecil durasi/langkah, semakin cepat)
                        const duration = 1500; // 1.5 detik
                        const increment = target / (duration / 16);

                        const updateCount = () => {
                            count += increment;
                            if (count < target) {
                                num.innerText = Math.floor(count) + suffix;
                                requestAnimationFrame(updateCount);
                            } else {
                                num.innerText = target + suffix;
                            }
                        };

                        updateCount();
                    });

                    animated = true;
                }
            });
        },
        { threshold: 0.3 },
    ); // Memicu animasi saat section 2 terlihat 30% di layar

    if (section2) {
        observer.observe(section2);
    }
});

// Fungsi Membuka Lightbox saat Foto Diklik
function openLightbox(imageSrc) {
    const modal = document.getElementById("imageLightbox");
    const modalImg = document.getElementById("lightboxImg");
    modal.style.display = "block";
    modalImg.src = imageSrc;
}

// Fungsi Menutup Lightbox
function closeLightbox() {
    document.getElementById("imageLightbox").style.display = "none";
}

// Script Animasi Masuk dari Bawah saat Di-scroll
document.addEventListener("DOMContentLoaded", function () {
    const sectionContainer = document.querySelector(".section4-container");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    sectionContainer.classList.add("show-animate");
                }
            });
        },
        { threshold: 0.2 },
    );

    if (sectionContainer) {
        observer.observe(sectionContainer);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const leftCard = document.querySelector(".section4-left-card");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    leftCard.classList.add("show-animate");
                }
            });
        },
        { threshold: 0.2 },
    );

    if (leftCard) {
        observer.observe(leftCard);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const leftImage = document.querySelector(".section4-left-image");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    leftImage.classList.add("show-animate");
                }
            });
        },
        { threshold: 0.2 },
    );

    if (leftImage) {
        observer.observe(leftImage);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const cardWrapper = document.querySelector(".card-with-badges-wrapper");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    cardWrapper.classList.add("show-animate");
                }
            });
        },
        { threshold: 0.2 },
    );

    if (cardWrapper) {
        observer.observe(cardWrapper);
    }
});

// JavaScript untuk Animasi Scroll Konsisten
document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.querySelector(".section4-elements-wrapper");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    wrapper.classList.add("show-animate");
                }
            });
        },
        { threshold: 0.2 },
    );

    if (wrapper) {
        observer.observe(wrapper);
    }
});
