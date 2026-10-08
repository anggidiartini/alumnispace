/* =========================================================
   detail-event-floating.js
   Logic untuk widget mengambang: tombol "kembali ke atas"
   dan bubble WhatsApp, dipakai di halaman detail event.
   ========================================================= */

(function () {
    "use strict";

    /* ---------- Tombol kembali ke atas ---------- */

    const backToTopBtn = document.getElementById("back-to-top");

    if (backToTopBtn) {
        function toggleBackToTop() {
            if (window.scrollY > 400) {
                backToTopBtn.classList.add("show");
            } else {
                backToTopBtn.classList.remove("show");
            }
        }

        toggleBackToTop();
        window.addEventListener("scroll", toggleBackToTop, { passive: true });

        backToTopBtn.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    /* ---------- Bubble WhatsApp ---------- */

    const waWidget = document.getElementById("wa-widget");
    const waButton = document.getElementById("wa-button");
    const waBubble = document.getElementById("wa-bubble");
    const waBubbleClose = document.getElementById("wa-bubble-close");

    if (waWidget && waButton && waBubble) {
        let bubbleShownOnce = false;

        // Tampilkan bubble sekali secara otomatis beberapa detik setelah halaman dibuka
        window.setTimeout(function () {
            if (!bubbleShownOnce) {
                waBubble.classList.add("show");
                bubbleShownOnce = true;
            }
        }, 2500);

        waButton.addEventListener("click", function (event) {
            // Kalau bubble belum kelihatan, klik pertama buka bubble dulu
            // alih-alih langsung lompat ke WhatsApp.
            if (!waBubble.classList.contains("show")) {
                event.preventDefault();
                waBubble.classList.add("show");
                return;
            }
        });

        if (waBubbleClose) {
            waBubbleClose.addEventListener("click", function (event) {
                event.preventDefault();
                event.stopPropagation();
                waBubble.classList.remove("show");
            });
        }

        document.addEventListener("click", function (event) {
            if (!waWidget.contains(event.target)) {
                waBubble.classList.remove("show");
            }
        });
    }
})();
