document.addEventListener("DOMContentLoaded", () => {
    // 1. Observer untuk Animasi Scroll (reveal-onscroll)
    const observerCallback = (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("in-view");
                // Kalau mau animasinya cuma sekali pas di-scroll, bisa di-unobserve:
                // observer.unobserve(entry.target);
            }
        });
    };

    const observerOptions = {
        threshold: 0.15,
    };

    const scrollObserver = new IntersectionObserver(
        observerCallback,
        observerOptions,
    );
    document.querySelectorAll(".reveal-onscroll").forEach((el) => {
        scrollObserver.observe(el);
    });

    // 2. Tombol Scroll ke Lowongan
    const viewJobsBtn = document.getElementById("viewJobsButton");
    if (viewJobsBtn) {
        viewJobsBtn.addEventListener("click", () => {
            const lowonganSection = document.getElementById("lowongan");
            if (lowonganSection) {
                lowonganSection.scrollIntoView({ behavior: "smooth" });
            }
        });
    }

    // 3. Tombol Back to Top
    const backToTopBtn = document.getElementById("back-to-top");
    if (backToTopBtn) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                backToTopBtn.style.display = "grid";
            } else {
                backToTopBtn.style.display = "none";
            }
        });

        backToTopBtn.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    // 4. Toggle Accordion Detail Lowongan
    document.querySelectorAll(".dc-job-detail-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const jobArticle = btn.closest(".dc-job");
            const isExpanded = jobArticle.classList.toggle("is-expanded");
            btn.setAttribute("aria-expanded", isExpanded);
            btn.textContent = isExpanded ? "Tutup Detail" : "Lihat Detail";
        });
    });

    // 5. Tombol Bookmark / Simpan Perusahaan
    const bookmarkBtn = document.getElementById("bookmarkButton");
    const toast = document.getElementById("toast");

    function showToast(message) {
        if (!toast) return;
        toast.textContent = message;
        toast.classList.add("show");
        setTimeout(() => {
            toast.classList.remove("show");
        }, 2500);
    }

    if (bookmarkBtn) {
        bookmarkBtn.addEventListener("click", () => {
            const isSaved = bookmarkBtn.classList.toggle("is-saved");
            bookmarkBtn.setAttribute("aria-pressed", isSaved);
            if (isSaved) {
                showToast("Perusahaan berhasil disimpan ke daftar favorit!");
            } else {
                showToast("Perusahaan dihapus dari daftar favorit.");
            }
        });
    }

    // 6. WhatsApp Bubble Widget Toggle
    const waBubble = document.getElementById("wa-bubble");
    const waClose = document.getElementById("wa-bubble-close");
    const waButton = document.getElementById("wa-button");

    if (waBubble && waClose) {
        // Tampilkan bubble otomatis setelah 1.5 detik
        setTimeout(() => {
            waBubble.style.display = "block";
        }, 1500);

        waClose.addEventListener("click", (e) => {
            e.stopPropagation();
            waBubble.style.display = "none";
        });
    }
});
