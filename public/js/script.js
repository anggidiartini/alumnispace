document.addEventListener("DOMContentLoaded", () => {
    lucide.createIcons();

    const showToast = (message) => {
        const toast = document.getElementById("toast");
        toast.textContent = message;
        toast.classList.add("show");
        clearTimeout(showToast._t);
        showToast._t = setTimeout(() => toast.classList.remove("show"), 2600);
    };

    /* ------------------------------------------------------------------
     * Dropdown menu navigasi (desktop)
     * ------------------------------------------------------------------ */
    const closeAllDropdowns = () => {
        document.querySelectorAll(".nav-drop").forEach((el) => {
            el.classList.remove("open");
            const btn = el.querySelector("[data-dropdown]");
            if (btn) btn.setAttribute("aria-expanded", "false");
        });
    };

    document.querySelectorAll("[data-dropdown]").forEach((button) => {
        button.addEventListener("click", () => {
            const parent = button.closest(".nav-drop");
            const isOpen = parent.classList.toggle("open");
            button.setAttribute("aria-expanded", String(isOpen));
            document.querySelectorAll(".nav-drop").forEach((other) => {
                if (other !== parent) {
                    other.classList.remove("open");
                    other
                        .querySelector("[data-dropdown]")
                        .setAttribute("aria-expanded", "false");
                }
            });
        });
    });

    document.addEventListener("click", (e) => {
        if (!e.target.closest(".nav-drop")) closeAllDropdowns();
    });

    /* ------------------------------------------------------------------
     * Menu mobile
     * ------------------------------------------------------------------ */
    const mobileToggle = document.getElementById("mobile-toggle");
    const mobileNav = document.getElementById("mobile-nav");
    mobileToggle.addEventListener("click", () => {
        const open = mobileNav.classList.toggle("open");
        mobileToggle.setAttribute("aria-expanded", String(open));
    });
    const closeMobileNav = () => {
        mobileNav.classList.remove("open");
        mobileToggle.setAttribute("aria-expanded", "false");
    };

    /* ------------------------------------------------------------------
     * AUTH: status login sederhana (disimpan di localStorage utk demo)
     * ------------------------------------------------------------------ */
    const AUTH_KEY = "ac_logged_in";
    const AUTH_EMAIL_KEY = "ac_user_email";
    let isLoggedIn = localStorage.getItem(AUTH_KEY) === "true";

    const guestActions = document.getElementById("guest-actions");
    const userActions = document.getElementById("user-actions");
    const userEmailLabel = document.getElementById("user-email-label");
    const userAvatar = document.getElementById("user-avatar");
    const mobileOpenLogin = document.getElementById("mobile-open-login");
    const mobileLogoutBtn = document.getElementById("mobile-logout-btn");
    const lockedTeaser = document.getElementById("locked-teaser");
    const authSections = [...document.querySelectorAll(".auth-section")];
    const lockIcons = [
        ...document.querySelectorAll('[data-auth-link] i[data-lucide="lock"]'),
    ];

    const applyAuthState = ({ animate = false } = {}) => {
        const email = localStorage.getItem(AUTH_EMAIL_KEY) || "";

        if (isLoggedIn) {
            guestActions.classList.add("hidden");
            userActions.classList.remove("hidden");
            userActions.classList.add("flex");
            mobileOpenLogin.classList.add("hidden");
            mobileLogoutBtn.classList.remove("hidden");
            mobileLogoutBtn.classList.add("flex");
            userEmailLabel.textContent = email ? email.split("@")[0] : "Alumni";
            userAvatar.textContent = (email ? email[0] : "A").toUpperCase();

            lockedTeaser.classList.add("hidden-teaser");
            authSections.forEach((section, i) => {
                if (!section.classList.contains("unlocked")) {
                    if (animate) {
                        section.style.animationDelay = `${i * 0.08}s`;
                    }
                    section.classList.add("unlocked");
                }
            });
            lockIcons.forEach(
                (icon) => icon.closest("[data-lucide]") && icon.remove(),
            );
        } else {
            guestActions.classList.remove("hidden");
            userActions.classList.add("hidden");
            userActions.classList.remove("flex");
            mobileOpenLogin.classList.remove("hidden");
            mobileLogoutBtn.classList.add("hidden");
            mobileLogoutBtn.classList.remove("flex");

            lockedTeaser.classList.remove("hidden-teaser");
            authSections.forEach((section) =>
                section.classList.remove("unlocked"),
            );
        }
    };

    applyAuthState();

    /* ------------------------------------------------------------------
     * Redirect ke halaman login terpisah (login.blade.php)
     * ------------------------------------------------------------------ */
    const redirectToLogin = () => {
        window.location.href = "/login"; // Sesuaikan dengan route halaman login Anda
    };

    document
        .getElementById("open-login")
        ?.addEventListener("click", redirectToLogin);

    mobileOpenLogin?.addEventListener("click", () => {
        closeMobileNav();
        redirectToLogin();
    });

    document
        .getElementById("teaser-login-btn")
        ?.addEventListener("click", redirectToLogin);

    const doLogout = () => {
        isLoggedIn = false;
        localStorage.setItem(AUTH_KEY, "false");
        localStorage.removeItem(AUTH_EMAIL_KEY);
        applyAuthState();
        showToast("Kamu telah keluar dari akun.");
        window.scrollTo({ top: 0, behavior: "smooth" });
    };

    document.getElementById("logout-btn")?.addEventListener("click", doLogout);
    mobileLogoutBtn?.addEventListener("click", () => {
        closeMobileNav();
        doLogout();
    });

    /* ------------------------------------------------------------------
     * Filter alumni berdasarkan angkatan & bidang
     * ------------------------------------------------------------------ */
    const yearFilter = document.getElementById("year-filter");
    const fieldFilter = document.getElementById("field-filter");
    const filterAlumni = () => {
        let shown = 0;
        document.querySelectorAll("#alumni-list article").forEach((card) => {
            const okay =
                (yearFilter.value === "all" ||
                    card.dataset.year === yearFilter.value) &&
                (fieldFilter.value === "all" ||
                    card.dataset.field === fieldFilter.value);
            card.classList.toggle("hidden", !okay);
            if (okay) shown++;
        });
        document
            .getElementById("alumni-empty")
            .classList.toggle("hidden", shown !== 0);
    };
    yearFilter?.addEventListener("change", filterAlumni);
    fieldFilter?.addEventListener("change", filterAlumni);

    /* ------------------------------------------------------------------
     * Tab media (Artikel / Galeri)
     * ------------------------------------------------------------------ */
    const activateTab = (tabName) => {
        if (!tabName) return;
        const targetBtn = document.querySelector(
            `.tab-btn[data-tab="${tabName}"]`,
        );
        if (!targetBtn) return;
        document
            .querySelectorAll(".tab-btn")
            .forEach((tab) => tab.setAttribute("aria-selected", "false"));
        document
            .querySelectorAll(".media-panel")
            .forEach((panel) => panel.classList.remove("active"));
        targetBtn.setAttribute("aria-selected", "true");
        document.getElementById(tabName)?.classList.add("active");
    };

    document
        .querySelectorAll(".tab-btn")
        .forEach((button) =>
            button.addEventListener("click", () =>
                activateTab(button.dataset.tab),
            ),
        );

    /* ------------------------------------------------------------------
     * Carousel testimoni
     * ------------------------------------------------------------------ */
    const testimonials = [...document.querySelectorAll(".testimonial")];
    let testimonialIndex = 0;
    const showTestimonial = (next) => {
        if (testimonials.length === 0) return;
        testimonials[testimonialIndex].classList.remove("active");
        testimonialIndex = (next + testimonials.length) % testimonials.length;
        testimonials[testimonialIndex].classList.add("active");
    };
    document
        .getElementById("prev-testimonial")
        ?.addEventListener("click", () =>
            showTestimonial(testimonialIndex - 1),
        );
    document
        .getElementById("next-testimonial")
        ?.addEventListener("click", () =>
            showTestimonial(testimonialIndex + 1),
        );

    /* ------------------------------------------------------------------
     * Navigasi terpadu (nav desktop, mobile, footer, tombol CTA)
     * - Jika link butuh login (data-auth-link) & belum login -> notif + arahkan ke halaman login
     * - Jika sudah login / link publik -> scroll halus + aktifkan tab bila perlu
     * ------------------------------------------------------------------ */
    document.querySelectorAll(".js-nav-link").forEach((link) => {
        link.addEventListener("click", (e) => {
            const targetSelector =
                link.dataset.target || link.getAttribute("href");
            const needsAuth = link.hasAttribute("data-auth-link");

            if (needsAuth && !isLoggedIn) {
                e.preventDefault();
                closeAllDropdowns();
                closeMobileNav();
                const label = link.dataset.authLabel || "fitur ini";
                showToast(`🔒 Silakan login dulu untuk mengakses ${label}`);
                redirectToLogin();
                return;
            }

            e.preventDefault();
            closeAllDropdowns();
            closeMobileNav();
            if (link.dataset.tabTarget) activateTab(link.dataset.tabTarget);
            const target = document.querySelector(targetSelector);
            if (target) {
                requestAnimationFrame(() =>
                    target.scrollIntoView({
                        behavior: "smooth",
                        block: "start",
                    }),
                );
            }
        });
    });

    /* ------------------------------------------------------------------
     * Tombol-tombol aksi demo (belum terhubung ke fungsi nyata)
     * ------------------------------------------------------------------ */
    document
        .querySelectorAll(".demo-action")
        .forEach((button) =>
            button.addEventListener("click", () =>
                showToast("Ini adalah aksi demo yang siap dikembangkan."),
            ),
        );

    /* ------------------------------------------------------------------
     * Scroll reveal animation (IntersectionObserver)
     * ------------------------------------------------------------------ */
    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("in-view");
                    revealObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15, rootMargin: "0px 0px -60px 0px" },
    );

    const observeReveals = () => {
        document
            .querySelectorAll(".reveal-onscroll:not(.in-view)")
            .forEach((el) => revealObserver.observe(el));
    };
    observeReveals();

    /* ------------------------------------------------------------------
     * Counter animasi untuk section statistik
     * ------------------------------------------------------------------ */
    const animateCount = (el) => {
        const target = parseInt(el.dataset.count, 10) || 0;
        const suffix = el.dataset.suffix || "";
        const numberEl = el.querySelector(".stat-number");
        if (!numberEl) return;
        const duration = 1400;
        const start = performance.now();
        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            numberEl.textContent =
                Math.round(eased * target).toLocaleString("id-ID") + suffix;
            if (progress < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    };

    const statObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    animateCount(entry.target);
                    statObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.4 },
    );
    document
        .querySelectorAll(".stat-card[data-count]")
        .forEach((el) => statObserver.observe(el));

    /* ------------------------------------------------------------------
     * Ketika section gated dibuka setelah login, aktifkan reveal utk elemen barunya
     * ------------------------------------------------------------------ */
    const authObserver = new MutationObserver(() => observeReveals());
    authSections.forEach((section) =>
        authObserver.observe(section, {
            attributes: true,
            attributeFilter: ["class"],
        }),
    );

    /* ------------------------------------------------------------------
     * Floating WhatsApp widget
     * ------------------------------------------------------------------ */
    const waBubble = document.getElementById("wa-bubble");
    const waButton = document.getElementById("wa-button");
    const waBubbleClose = document.getElementById("wa-bubble-close");

    setTimeout(() => {
        if (waBubble) waBubble.classList.add("show");
    }, 2200);

    waButton?.addEventListener("click", () =>
        waBubble?.classList.remove("show"),
    );
    waBubbleClose?.addEventListener("click", () =>
        waBubble?.classList.remove("show"),
    );

    /* ------------------------------------------------------------------
     * Tombol kembali ke atas
     * ------------------------------------------------------------------ */
    const backToTop = document.getElementById("back-to-top");
    const toggleBackToTop = () =>
        backToTop?.classList.toggle("show", window.scrollY > 420);
    window.addEventListener("scroll", toggleBackToTop, { passive: true });
    toggleBackToTop();
    backToTop?.addEventListener("click", () =>
        window.scrollTo({ top: 0, behavior: "smooth" }),
    );
});
